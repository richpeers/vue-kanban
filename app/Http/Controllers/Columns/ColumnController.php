<?php

namespace App\Http\Controllers\Columns;

use App\Domain\Columns\Repositories\ColumnRepository;
use App\Http\Requests\Columns\CreateColumnFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ColumnController extends Controller
{
    /**
     * @var ColumnRepository
     */
    protected $columns;

    /**
     * ColumnController constructor.
     *
     * @param ColumnRepository $columns
     */
    public function __construct(ColumnRepository $columns)
    {
        $this->columns = $columns;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateColumnFormRequest $request
     * @return JsonResponse
     */
    public function store(CreateColumnFormRequest $request): JsonResponse
    {
        $column = $this->columns->create([
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'board_id' => $request->input('board_id')
        ]);

        return response()->json([
            'data' => $column
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json([
            'data' => $this->columns->find($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateColumnFormRequest $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(CreateColumnFormRequest $request, $id): JsonResponse
    {
        $team = $this->columns->update($id, [
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'board_id' => $request->input('board_id')
        ]);

        return response()->json([
            'data' => $team
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json([
            'data' => $this->columns->delete($id)
        ], 200);
    }
}
