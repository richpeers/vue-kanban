<?php

namespace App\Domain\Boards\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Boards\Repositories\BoardRepository as BoardRepositoryInterface;
use App\Domain\Boards\Board;

class BoardRepository extends RepositoryAbstract implements BoardRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Board::class;
    }
}