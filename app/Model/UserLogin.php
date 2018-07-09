<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserLogin.
 *
 * @mixin \Eloquent
 */
class UserLogin extends Model
{
    const UPDATED_AT = null;

    const ACTION_REGISTER = 'register';

    const ACTION_LOGIN = 'login';
}
