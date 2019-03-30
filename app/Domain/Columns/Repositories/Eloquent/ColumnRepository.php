<?php

namespace App\Domain\Columns\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Cards\Repositories\CardRepository;
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

    public function updateColumnOrder($boardId, array $columnOrder)
    {
        $columns = $this->entity->where('board_id', $boardId)->with('cards')->get();

        $columns->each(function ($column) use ($columnOrder) {
            $column->update([
                'order' => $columnOrder[$column->id]['order']
            ]);

            $this->updateCardOrder($column, $columnOrder[$column->id]['cards']);
        });
    }

    protected function updateCardOrder($column, $cardOrder)
    {
        $cards = app(CardRepository::class);

        foreach ($cardOrder as $cardId => $order) {
            $cards->update($cardId, [
                'column_id' => $column->id,
                'order' => $order
            ]);
        }

    }
}
