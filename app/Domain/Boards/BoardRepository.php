<?php

namespace App\Domain\Boards;

use App\App\Repositories\RepositoryAbstract;

class BoardRepository extends RepositoryAbstract
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Board::class;
    }
}
