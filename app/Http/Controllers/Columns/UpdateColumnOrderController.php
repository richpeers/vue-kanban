<?php

namespace App\Http\Controllers\Columns;

use App\Domain\Columns\Repositories\ColumnRepository;
use App\Http\Requests\Columns\OrderColumnsFormRequest;
use App\Http\Controllers\Controller;

class UpdateColumnOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  OrderColumnsFormRequest $request
     * @param  ColumnRepository $columnRepository
     * @return \Illuminate\Http\Response
     */
    public function __invoke(OrderColumnsFormRequest $request, ColumnRepository $columnRepository)
    {
        $columnRepository->updateColumnOrder($request->input('boardId'), $request->input('columnOrder'));

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
