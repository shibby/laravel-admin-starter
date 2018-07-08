<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @throws \InvalidArgumentException
     */
    public function boot()
    {
        $this->registerPolicies();
        \Gate::define('admin', function (User $user) {
            return User::ROLE_ADMIN === $user->role_id;
        });
        \Gate::define('editor', function (User $user) {
            return $user->role_id >= User::ROLE_EDITOR;
        });
    }
}
