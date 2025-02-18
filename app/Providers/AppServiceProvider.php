<?php

namespace App\Providers;

use App\Http\Services\Auth\AuthService;
use App\Http\Services\Auth\AuthServiceInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap any application Services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(191);
    }
}
