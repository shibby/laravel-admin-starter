<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserLoggedInEvent
{
    use Dispatchable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * Create a new event instance.
     *
     * @param User   $user
     * @param string $ipAddress
     * @param string $userAgent
     */
    public function __construct(User $user, string $ipAddress, string $userAgent)
    {
        $this->user = $user;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
