<?php

namespace App\Domain\Columns;

use App\App\Repositories\RepositoryAbstract;
use App\Domain\Cards\CardRepository;
use App\App\Repositories\Exceptions\NoEntityDefined;

class ColumnRepository extends RepositoryAbstract
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Column::class;
    }

    /**
     * @param int $boardId
     * @param array $columnOrder
     * @throws NoEntityDefined
     */
    public function updateOrder(int $boardId, array $columnOrder)
    {
        $columns = $this->findWhere('board_id', $boardId);

        $cards = new CardRepository();

        $columns->each(function ($column) use ($columnOrder, $cards) {

            $column->update([
                'order' => $columnOrder[$column->id]['order']
            ]);

            $cardOrder = $columnOrder[$column->id]['cards'];

            foreach ($cardOrder as $cardId => $order) {

                $cards->update($cardId, [
                    'column_id' => $column->id,
                    'order' => $order
                ]);

            }
        });
    }
}
