<?php

namespace App\Domain\Columns\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Columns\Repositories\ColumnRepository as ColumnRepositoryInterface;
use App\Domain\Columns\Column;

class ColumnRepository extends RepositoryAbstract implements ColumnRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Column::class;
    }
}