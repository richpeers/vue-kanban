<?php

namespace App\App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Users\Repositories\UserRepository as UserRepositoryInterface;
use App\Domain\Users\Repositories\Eloquent\UserRepository;

use App\Domain\Boards\Repositories\BoardRepository as BoardRepositoryInterface;
use App\Domain\Boards\Repositories\Eloquent\BoardRepository;

use App\Domain\Cards\Repositories\CardRepository as CardRepositoryInterface;
use App\Domain\Cards\Repositories\Eloquent\CardRepository;

use App\Domain\Columns\Repositories\ColumnRepository as ColumnRepositoryInterface;
use App\Domain\Columns\Repositories\Eloquent\ColumnRepository;

use App\Domain\Comments\Repositories\CommentRepository as CommentRepositoryInterface;
use App\Domain\Comments\Repositories\Eloquent\CommentRepository;

use App\Domain\Teams\Repositories\TeamRepository as TeamRepositoryInterface;
use App\Domain\Teams\Repositories\Eloquent\TeamRepository;

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
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(ColumnRepositoryInterface::class, ColumnRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
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
