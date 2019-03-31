<?php

namespace App\Domain\Boards\Criteria;

class OrderedColumnsAndCards
{
    /**
     * @param $entity
     * @return mixed
     */
    public function apply($entity)
    {
        return $entity->with([
            'columns' => function ($column) {
                $column->select('id', 'board_id', 'title', 'order')
                    ->with([
                        'cards' => function ($card) {
                            $card->select('id', 'column_id', 'title', 'description', 'order')
                                ->orderBy('order');
                        }
                    ])->orderBy('order');
            }
        ]);
    }
}
