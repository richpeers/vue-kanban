<?php

namespace App\Domain\Users;

use App\App\Repositories\RepositoryAbstract;
use Illuminate\Http\Request;

class UserRepository extends RepositoryAbstract
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
