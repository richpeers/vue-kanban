<?php

namespace App\Domain\Teams\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Teams\Repositories\TeamRepository as TeamRepositoryInterface;
use App\Domain\Teams\Team;
use Illuminate\Http\Request;

class TeamRepository extends RepositoryAbstract implements TeamRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Team::class;
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
     * @param $team
     * @param $userId
     * @return mixed
     */
    public function addMember($team, $userId)
    {
        return $team->syncWithoutDetaching([$userId]);
    }
}