<?php

namespace App\Http\Controllers\Boards;

use App\Domain\Boards\BoardRepository;
use App\Domain\Boards\Criteria\OrderedColumnsAndCards;
use App\Domain\Boards\Criteria\OwnedByUser;
use App\Domain\Teams\Team;
use App\Domain\Users\User;
use App\Http\Requests\Boards\CreateBoardFormRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Board as BoardResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BoardController extends Controller
{
    /**
     * @var BoardRepository
     */
    protected $boards;

    /**
     * BoardController constructor.
     *
     * @param BoardRepository $boards
     */
    public function __construct(BoardRepository $boards)
    {
        $this->boards = $boards;
    }

    /**
     * Get board listing.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $data = $this->boards->withCriteria([
            new OwnedByUser(auth()->id())
        ])->all();

        return BoardResource::collection($data);
    }

    /**
     * Store a newly created board.
     *
     * @param CreateBoardFormRequest $request
     * @return BoardResource
     */
    public function store(CreateBoardFormRequest $request): BoardResource
    {
        $board = $this->boards->create([
            'title' => $request->input('title'),
            'owner_type' => $request->has('team_id') ? Team::class : User::class,
            'owner_id' => $request->has('team_id') ? $request->input('team_id') : $request->user()->id,
            'private' => $request->input('private')
        ]);

        return new BoardResource($board);
    }

    /**
     * Get board with columns and cards.
     *
     * @param string $id (hashId)
     * @return BoardResource
     */
    public function show(string $id): BoardResource
    {
        $board = $this->boards->withCriteria([
            new OrderedColumnsAndCards()
        ])->findByHashId($id);

        return new BoardResource($board);
    }

    /**
     * Update the board.
     *
     * @param CreateBoardFormRequest $request
     * @param int $id
     * @return BoardResource
     */
    public function update(CreateBoardFormRequest $request, int $id): BoardResource
    {
        $board = $this->boards->update($id, [
            'title' => $request->input('title'),
            'private' => $request->input('private')
        ]);

        return new BoardResource($board);
    }

    /**
     * Soft delete the board. (archive it)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json([
            'success' => $this->boards->delete($id)
        ], 200);
    }
}
