<?php

namespace App\Domain\Teams;

use App\App\Repositories\RepositoryAbstract;
use Illuminate\Http\Request;

class TeamRepository extends RepositoryAbstract
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
