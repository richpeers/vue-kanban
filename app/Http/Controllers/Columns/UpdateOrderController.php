<?php

namespace App\Http\Controllers\Columns;

use App\Domain\Columns\ColumnRepository;
use App\Http\Requests\Columns\OrderColumnsFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\App\Repositories\Exceptions\NoEntityDefined;

class UpdateOrderController extends Controller
{
    /**
     * Update column and card order.
     *
     * @param OrderColumnsFormRequest $request
     * @param ColumnRepository $columns
     * @return JsonResponse
     * @throws NoEntityDefined
     */
    public function __invoke(OrderColumnsFormRequest $request, ColumnRepository $columns): JsonResponse
    {
        $columns->updateOrder(
            $request->input('boardId'),
            $request->input('columnOrder')
        );

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
