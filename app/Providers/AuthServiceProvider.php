<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('hasUnitKerja', function (User $user) {
            return $user->authable->unit;
        });

        Gate::define('Anggota', function ($user) {
            return $user->authable_type == 'App\Models\Anggota';
        });

        Gate::define('Petugas', function ($user) {
            return $user->authable_type == 'App\Models\Petugas';
        });

        Gate::define('Admin', function ($user) {
            return $user->authable_type == 'App\Models\Admin';
        });

        Gate::define('Administrator', function ($user) {
            return $user->authable_type != 'App\Models\Anggota';
        });
    }
}
