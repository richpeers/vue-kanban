<?php

namespace App\Http\Controllers\Cards;

use App\Domain\Cards\Repositories\CardRepository;
use App\Http\Requests\Cards\CreateCardFormRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    /**
     * @var CardRepository
     */
    protected $cards;

    /**
     * CardController constructor.
     *
     * @param CardRepository $cards
     */
    public function __construct(CardRepository $cards)
    {
        $this->cards = $cards;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCardFormRequest $request
     * @return JsonResponse
     */
    public function store(CreateCardFormRequest $request): JsonResponse
    {
        $card = $this->cards->create([
            'column_id' => $request->input('column_id'),
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due' => $request->has('due') ? Carbon::createFromFormat('Y-m-d H:i', $request->input('due')) : null
        ]);

        return response()->json([
            'data' => $card
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
            'data' => $this->cards->findByHashId($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $card = $this->cards->update($id, [
            'column_id' => $request->input('column_id'),
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due' => $request->has('due') ? Carbon::createFromFormat('Y-m-d H:i', $request->input('due')) : null
        ]);

        return response()->json([
            'data' => $card
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
            'data' => $this->cards->delete($id)
        ], 200);
    }
}
