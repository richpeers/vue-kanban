<?php

namespace App\Http\Controllers\Comments;

use App\Domain\Comments\CommentRepository;
use App\Http\Requests\Cards\CreateCardFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    protected $comments;

    /**
     * CardController constructor.
     *
     * @param CommentRepository $comments
     */
    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Store a newly created comment.
     *
     * @param CreateCardFormRequest $request
     * @return CommentResource
     */
    public function store(CreateCardFormRequest $request): CommentResource
    {
        $comment = $this->comments->create([
            'card_id' => $request->input('card_id'),
            'body' => $request->input('body'),
        ]);

        return new CommentResource($comment);
    }

    /**
     * Get a comment.
     *
     * @param int $id
     * @return CommentResource
     */
    public function show(int $id): CommentResource
    {
        $comment = $this->comments->findByHashId($id);

        return new CommentResource($comment);
    }

    /**
     * Update a comment.
     *
     * @param CreateCardFormRequest $request
     * @param int $id
     * @return CommentResource
     */
    public function update(CreateCardFormRequest $request, int $id): CommentResource
    {
        $comment = $this->comments->update($id, [
            'card_id' => $request->input('card_id'),
            'body' => $request->input('body'),
        ]);

        return new CommentResource($comment);
    }

    /**
     * Soft delete a comment. (archive it)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json([
            'success' => $this->comments->delete($id)
        ], 200);
    }
}
