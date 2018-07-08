<?php

namespace App\Service;

use App\Events\StatEvent;
use App\Events\UserLoggedInEvent;
use App\Events\UserRegisteredEvent;
use App\Model\Media;
use App\Model\UserLink;
use App\User;

class UserService
{
    /**
     * @var MediaService
     */
    private $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function getUser(int $id): ?User
    {
        return User::find($id);
    }

    public function saveUser(User $user, array $post): User
    {
        $user->name = $post['name'];
        if (!empty($post['email'])) {
            $user->email = $post['email'];
        }
        if (!empty($post['city_id'])) {
            $user->city_id = $post['city_id'];
        }
        if (!empty($post['password'])) {
            $user->password = \Hash::make($post['password']);
        }
        if (!empty($post['status_id'])) {
            $user->status_id = $post['status_id'];
        }
        if (!empty($post['role_id'])) {
            $user->role_id = $post['role_id'];
        }
        if (!empty($post['avatar_media_id'])) {
            $user->avatar_media_id = $post['avatar_media_id'];
        }
        if (!empty($post['avatar_media'])) {
            $user->avatar_media_id = $post['avatar_media']->id;
        }
        if (!empty($post['facebook_id'])) {
            $user->facebook_id = $post['facebook_id'];
        }
        if (!empty($post['facebook_token'])) {
            $user->facebook_token = $post['facebook_token'];
        }
        if (!empty($post['facebook_refresh_token'])) {
            $user->facebook_refresh_token = $post['facebook_refresh_token'];
        }
        if (!empty($post['facebook_expires'])) {
            $user->facebook_expires = $post['facebook_expires'];
        }

        $user->save();

        if ($user->wasRecentlyCreated) {
            event(new UserRegisteredEvent(
                $user,
                $post['ip_address'] ?? \Request::getClientIp(),
                $post['user_agent'] ?? \Agent::getUserAgent()
                )
            );
        }

        return $user;
    }

    public function attempLogin($array, $ipAddress, $userAgent)
    {
        $result = \Auth::attempt($array, true);
        if (true === $result) {
            if (array_key_exists('email', $array)) {
                $user = User::where('email', $array['email'])
                    ->first(); //bu fonksion extra 1 sorguya sebep oluyor
            } elseif (array_key_exists('username', $array)) {
                $user = User::where('username', $array['username'])
                    ->first();
            } elseif (array_key_exists('id', $array)) {
                $user = User::where('id', $array['id'])
                    ->first();
            }
            event(new UserLoggedInEvent($user, $ipAddress, $userAgent));
        }

        return $result;
    }

    public function getUserByIdentifier($identifier)
    {
        return User::where('email', $identifier)
            ->orWhere('username', $identifier)
            ->first();
    }

    public function registerUser(User $user, array $post)
    {
        $postData['role_id'] = User::ROLE_USER;
        $postData['status_id'] = User::STATUS_APPROVE_PHONE;
        $user = $this->saveUser($user, $post);

        event(new UserRegisteredEvent($user, $post['ip_address'], $post['user_agent']));
    }

    public function getUserByFacebookId($fbId)
    {
        return User::where('facebook_id', $fbId)->first();
    }

    public function saveUserBySocial(\Laravel\Socialite\Two\User $social, User $user = null)
    {
        if (null === $user) {
            $user = new User();
            $user->register_ref = User::REGISTER_REF_FACEBOOK;
        }

        \Log::debug($social->user);

        $nickname = ($social->getNickname() ?: $social->getName());
        $email = $social->getEmail() ?: null;
        $gender = null;
        if ('male' === $social->user['gender']) {
            $gender = 1;
        } elseif ('female' === $social->user['gender']) {
            $gender = 0;
        }
        $user = $this->saveUser($user, [
            'gender' => $user->gender ?: $gender,
            'name' => $user->name ?: $social->getName(),
            'username' => $user->username ?: $nickname,
            'password' => !$user->id ? str_random(16) : null,
            'email' => $user->email ?: $email,
            'status_id' => !$user->id ? User::STATUS_ACTIVE : null,
            'role_id' => !$user->id ? User::ROLE_USER : null,
            'avatar_media' => !$user->id ? $this->downloadPhotoAndCreateMedia($social->getAvatar()) : null,
            'facebook_id' => $social->getId(),
            'facebook_token' => $social->token,
            'facebook_refresh_token' => $social->refreshToken,
            'facebook_expires' => date('Y-m-d H:i:s', $social->expiresIn),
        ]);

        if (!$user->id) {
            event(new UserRegisteredEvent($user, \Request::getClientIp(), \Agent::getUserAgent()));
        } else {
            event(new UserLoggedInEvent($user, \Request::getClientIp(), \Agent::getUserAgent()));
        }

        return $user;
    }

    private function downloadPhotoAndCreateMedia($url): Media
    {
        $name = str_random().'.jpg';
        $file = file_get_contents($url);
        \File::put(storage_path('app/uploads/avatar').'/'.$name, $file);

        return $this->mediaService->saveMedia('/uploads/avatar/'.$name);
    }

    public function getUsers($options)
    {
        $users = User::query();

        if (array_key_exists('with', $options)) {
            $users->with($options['with']);
        }

        if (array_key_exists('status', $options)) {
            $users->where('status_id', $options['status']);
        }

        if (array_key_exists('limit', $options)) {
            $users->limit($options['limit']);
        }

        if (array_key_exists('tab', $options) && null !== $options['tab']) {
            if ('follower' === $options['tab']) {
                $users->orderBy('follower_count', 'DESC');
            } elseif ('following' === $options['tab']) {
                $users->orderBy('following_count', 'DESC');
            }
        } else {
            $users->orderBy($options['sort'] ?? 'id', $options['order'] ?? 'DESC');
        }

        if (array_key_exists('paginate', $options)) {
            return $users->paginate($options['paginate']);
        }

        return $users->get();
    }

    /**
     * @param $username
     *
     * @return User|null
     */
    public function getUserByUsername($username)
    {
        return User::where('username', $username)->first();
    }

    /**
     * @param User $user
     * @param $shouldUpdate
     *
     * @return int
     */
    public function updateUserProfileView(User $user, $shouldUpdate)
    {
        $sessionKey = 'visited_users__';
        try {
            $visitedUsers = \GuzzleHttp\json_decode(session($sessionKey), true);
        } catch (\InvalidArgumentException $exception) {
            $visitedUsers = [];
        }

        $view = $this->getProfileView($user);

        if (in_array($user->id, $visitedUsers, false)) {
            $shouldUpdate = false;
        }
        if (true === $shouldUpdate) {
            //event(new StatEvent($user, StatEvent::ACTION_VIEW));
            ++$view;

            //$redis = app('redis');
            //$redis->connection('profile_views')->set('user:views:'.$user->id, $view);

            $visitedUsers[] = $user->id;
            session(["$sessionKey" => \GuzzleHttp\json_encode($visitedUsers)]);
        }

        return $view;
    }

    public function getUserFollowers(User $user)
    {
        $users = User::with([
            'avatarMedia',
        ])
            ->whereRaw('users.id IN (select user_id from user_followers where following_user_id = '.$user->id.')');

        return $users->paginate(10);
    }

    public function getUserFollowings(User $user)
    {
        $users = User::with([
            'avatarMedia',
        ])
            ->whereRaw('users.id IN (select following_user_id from user_followers where user_id = '.$user->id.')');

        return $users->paginate(10);
    }

    public function getProfileView(User $user)
    {
        $redis = app('redis');

        //return $redis->connection('profile_views')->get('user:views:'.$user->id) ?: 0;
    }

    public function updateUserLink(User $user, string $identifier, $value)
    {
        $userLink = UserLink::where('user_id', $user->id)
            ->where('identifier', $identifier)
            ->first();
        if (!$userLink) {
            if (!$value) {
                return;
            }
            $userLink = new UserLink();
            $userLink->user_id = $user->id;
            $userLink->identifier = $identifier;
        }
        $userLink->link = $value;
        $userLink->save();
    }

    public function getUserCount(array $array)
    {
        $query = User::query();

        return $query->count();
    }

    public function toSelect()
    {
        return User::pluck('username', 'id')->toArray();
    }

    public function authenticateUser(User $user)
    {
        auth()->attempt();
    }

    public function updateStatus(User $user, $status)
    {
        $user->status_id = $status;
        $user->save();
    }
}
