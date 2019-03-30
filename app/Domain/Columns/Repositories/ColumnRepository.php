<?php

namespace App\Domain\Columns\Repositories;

interface ColumnRepository
{
    public function updateColumnOrder($boardId, array $columnOrder);
}