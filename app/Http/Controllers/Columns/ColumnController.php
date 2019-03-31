<?php

namespace App\Http\Controllers\Columns;

use App\Domain\Columns\ColumnRepository;
use App\Http\Requests\Columns\CreateColumnFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Column as ColumnResource;

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
     * Store a newly created column.
     *
     * @param CreateColumnFormRequest $request
     * @return ColumnResource
     */
    public function store(CreateColumnFormRequest $request): ColumnResource
    {
        $column = $this->columns->create([
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'board_id' => $request->input('board_id')
        ]);

        return new ColumnResource($column);
    }

    /**
     * Get a column.
     *
     * @param int $id
     * @return ColumnResource
     */
    public function show(int $id): ColumnResource
    {
        $column = $this->columns->find($id);

        return new ColumnResource($column);
    }

    /**
     * Update a column.
     *
     * @param CreateColumnFormRequest $request
     * @param int $id
     * @return ColumnResource
     */
    public function update(CreateColumnFormRequest $request, int $id): ColumnResource
    {
        $column = $this->columns->update($id, [
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'board_id' => $request->input('board_id')
        ]);

        return new ColumnResource($column);
    }

    /**
     * Soft delete a column. (archive it)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json([
            'success' => $this->columns->delete($id)
        ], 200);
    }
}
