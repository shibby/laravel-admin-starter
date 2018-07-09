<?php

namespace App;

use App\Model\City;
use App\Model\Helpers\UuidTrait;
use App\Model\Media;
use App\Model\UserLogin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    public $incrementing = false;

    use UuidTrait,Notifiable;

    public const STATUS_ACTIVE = 5;

    public const STATUS_WAITING_APPROVE = 1;

    public const STATUS_BANNED = -1;

    public const ROLE_ADMIN = 5;

    public const ROLE_EDITOR = 3;

    public const ROLE_USER = 1;

    public const ROLES = [
        1 => 'User',
        3 => 'Editor',
        5 => 'Admin',
    ];

    public const STATUSES = [
        -1 => 'Banned',
        1 => 'Waiting Approval',
        5 => 'Active',
    ];

    protected $casts = [
        'role_id' => 'integer',
        'status_id' => 'integer',
        'city_id' => 'integer',
    ];

    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function avatarMedia()
    {
        return $this->belongsTo(Media::class);
    }

    public function userLogins()
    {
        return $this->hasMany(UserLogin::class);
    }
}
