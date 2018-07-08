<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $loggedIn = false;

    public function login($typeOrEmail = 'admin')
    {
        if ($typeOrEmail === 'admin') {
            $typeOrEmail = 'admin@admin.com';
        }

        $user = User::where('email', $typeOrEmail)->first();
        if ($user) {
            $this->be($user);
            $this->loggedIn = true;
        }
    }

    public function mobile()
    {
        $this->session([
            'mobile' => true,
        ]);
    }
}
