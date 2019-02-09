<?php

namespace App\App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Users\Repositories\UserRepository as UserRepositoryInterface;
use App\Domain\Users\Repositories\Eloquent\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
