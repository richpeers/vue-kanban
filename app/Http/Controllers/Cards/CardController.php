<?php

namespace App\Http\Controllers\Cards;

use App\Domain\Cards\CardRepository;
use App\Http\Requests\Cards\CreateCardFormRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Card as CardResource;

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
     * Store a newly created card.
     *
     * @param CreateCardFormRequest $request
     * @return CardResource
     */
    public function store(CreateCardFormRequest $request): CardResource
    {
        $card = $this->cards->create([
            'column_id' => $request->input('column_id'),
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due' => $request->has('due') ? Carbon::createFromFormat('Y-m-d H:i', $request->input('due')) : null
        ]);

        return new CardResource($card);
    }

    /**
     * Get a card
     *
     * @param string $id (hashId)
     * @return CardResource
     */
    public function show(string $id): CardResource
    {
        $card = $this->cards->findByHashId($id);

        return new CardResource($card);
    }

    /**
     * Update a card.
     *
     * @param Request $request
     * @param int $id
     * @return CardResource
     */
    public function update(Request $request, int $id): CardResource
    {
        $card = $this->cards->update($id, [
            'column_id' => $request->input('column_id'),
            'order' => $request->input('order'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due' => $request->has('due') ? Carbon::createFromFormat('Y-m-d H:i', $request->input('due')) : null
        ]);

        return new CardResource($card);
    }

    /**
     * Soft delete a card. (archive it)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json([
            'success' => $this->cards->delete($id)
        ], 200);
    }
}
