<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
// nyalakan saat hosting
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // nyalakan saat hosting
        // Schema::defaultStringLength(191);

        Gate::define('Pegawai yang Dinilai', function (User $user) {
            return $user->role === 'Pegawai yang Dinilai';
        });

        Gate::define('Pejabat Penilai', function (User $user) {
            return $user->role === 'Pejabat Penilai';
        });

        Gate::define('Admin', function (User $user) {
            return $user->role === 'Admin';
        });

        Gate::define('Atasan', function (User $user) {
            return $user->role === 'Atasan Pejabat Penilai';
        });
    }
}
