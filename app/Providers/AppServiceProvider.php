<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
class AppServiceProvider extends ServiceProvider
{

    public const HOME = '/dashboard';
    public const TEACHER_HOME = '/teacher/dashboard';
    public const ADMIN_HOME = '/admin/dashboard';
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
        Vite::macro('image', fn (string $asset) => $this->asset("resources/svg/{$asset}"));



    }

}
