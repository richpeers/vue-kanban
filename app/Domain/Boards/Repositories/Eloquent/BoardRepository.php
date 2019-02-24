<?php

namespace App\Domain\Boards\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Boards\Repositories\BoardRepository as BoardRepositoryInterface;
use App\Domain\Boards\Board;
use App\Domain\Teams\Team;
use App\Domain\Users\User;
use Illuminate\Http\Request;

class BoardRepository extends RepositoryAbstract implements BoardRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Board::class;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function userIndex(Request $request)
    {
        return $this->findWhere('user_id', $request->user()->id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createPersonalBoard(Request $request)
    {
        return $this->create([
            'title' => $request->input('title'),
            'owner_type' => Team::class,
            'owner_id' => $request->input('team_id'),
            'private' => $request->input('private')
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createTeamBoard(Request $request)
    {
        return $this->create([
            'title' => $request->input('title'),
            'owner_type' => User::class,
            'owner_id' => $request->input('user_id'),
            'private' => $request->input('private')
        ]);
    }
}