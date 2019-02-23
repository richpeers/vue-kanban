<?php

namespace App\Domain\Teams\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Teams\Repositories\TeamRepository as TeamRepositoryInterface;
use App\Domain\Teams\Team;

class TeamRepository extends RepositoryAbstract implements TeamRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Team::class;
    }
}