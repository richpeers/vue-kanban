<?php

namespace App\Domain\Cards;

use App\App\Repositories\RepositoryAbstract;

class CardRepository extends RepositoryAbstract
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Card::class;
    }
}
