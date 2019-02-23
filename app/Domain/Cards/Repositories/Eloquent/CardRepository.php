<?php

namespace App\Domain\Cards\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Cards\Repositories\CardRepository as CardRepositoryInterface;
use App\Domain\Cards\Card;

class CardRepository extends RepositoryAbstract implements CardRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Card::class;
    }
}