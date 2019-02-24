<?php

namespace App\Domain\Users\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Users\Repositories\UserRepository as UserRepositoryInterface;
use App\Domain\Users\User;
use Illuminate\Http\Request;

class UserRepository extends RepositoryAbstract implements UserRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return User::class;
    }

    public function userTeamsWithBoards(Request $request)
    {
        return $request->user()
            ->teams()->with('boards')
            ->get();
    }
}