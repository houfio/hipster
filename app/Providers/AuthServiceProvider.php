<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('download-files', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('attach-detach-teacher', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('attach-detach-tag', function (User $user) {
            return $user->isManager();
        });

        Gate::define('view-deadlines', function (User $user) {
            return $user->isManager();
        });
    }
}
