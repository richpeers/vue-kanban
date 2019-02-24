<?php

namespace App\Http\Controllers\Comments;

use App\Domain\Comments\Repositories\CommentRepository;
use App\Http\Requests\Cards\CreateCardFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
     * Store a newly created resource in storage.
     *
     * @param  CreateCardFormRequest $request
     * @return Response
     */
    public function store(CreateCardFormRequest $request): Response
    {
        $comment = $this->comments->create([
            'card_id' => $request->input('card_id'),
            'body' => $request->input('body'),
        ]);

        return response()->json([
            'data' => $comment
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id): Response
    {
        return response()->json([
            'data' => $this->comments->findByHashId($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateCardFormRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(CreateCardFormRequest $request, $id): Response
    {
        $comment = $this->comments->update($id, [
            'card_id' => $request->input('card_id'),
            'body' => $request->input('body'),
        ]);

        return response()->json([
            'data' => $comment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id): Response
    {
        return response()->json([
            'data' => $this->comments->delete($id)
        ], 200);
    }
}
