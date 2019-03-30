<?php

namespace App\Http\Controllers\Boards;

use App\Domain\Boards\Repositories\BoardRepository;
use App\Http\Requests\Boards\CreateBoardFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    /**
     * @var BoardRepository
     */
    protected $boards;

    /**
     * BoardController constructor.
     * @param BoardRepository $boards
     */
    public function __construct(BoardRepository $boards)
    {
        $this->boards = $boards;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => $this->boards->userIndex($request)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBoardFormRequest $request
     * @return JsonResponse
     */
    public function store(CreateBoardFormRequest $request): JsonResponse
    {
        if ($request->has('team_id')) {
            $board = $this->boards->createTeamBoard($request);

        } else {
            $board = $this->boards->createPersonalBoard($request);
        }

        return response()->json([
            'data' => $board
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json([
            'data' => $this->boards->editBoard($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateBoardFormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CreateBoardFormRequest $request, $id): JsonResponse
    {
        $board = $this->boards->update($id, [
            'title' => $request->input('title'),
            'private' => $request->input('private')
        ]);

        return response()->json([
            'data' => $board
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json([
            'data' => $this->boards->delete($id)
        ], 200);
    }
}
