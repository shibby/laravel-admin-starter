<?php

namespace App\Service;

use App\Model\UserLogin;
use App\User;

class UserLoginService
{
    public function insertUserLogin(User $user, $action, $ipAddress, $userAgent): void
    {
        $l = new UserLogin();
        $l->user_id = $user->id;
        $l->action = $action;
        $l->ip_address = $ipAddress;
        $l->user_agent = $userAgent;
        $l->save();
    }
}
