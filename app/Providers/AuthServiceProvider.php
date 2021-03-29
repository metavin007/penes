<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
            // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        /* define a manager user role */
        Gate::define('isCEO', function($user) {
            return $user->role == 'CEO';
        });

        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->role == 'Admin';
        });

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role == 'User';
        });
    }

}
