<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('AdminSpv', function () {
            $role = Auth::user()->role ?? null;
            return in_array($role, ['Admin', 'Spv']);    
        });

        Blade::if('Admin', function () {
            $role = Auth::user()->role ?? null;
            return $role === 'Admin';    
        });

        Blade::if('Spv', function () {
            $role = Auth::user()->role ?? null;
            return $role === 'Spv';    
        });

        Blade::if('PetugasKebersihan', function () {
            $role = Auth::user()->role ?? null;
            return $role === 'Petugas Kebersihan';    
        });
    }
}
