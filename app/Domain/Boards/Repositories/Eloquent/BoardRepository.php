<?php

namespace App\Domain\Boards\Repositories\Eloquent;

use App\App\Repositories\Eloquent\RepositoryAbstract;
use App\Domain\Boards\Repositories\BoardRepository as BoardRepositoryInterface;
use App\Domain\Boards\Board;
use App\Domain\Teams\Team;
use App\Domain\Users\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class BoardRepository extends RepositoryAbstract implements BoardRepositoryInterface
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return Board::class;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function userIndex(Request $request)
    {
        return $this->entity->where('owner_id', $request->user()->id)->where('owner_type', User::class)->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createPersonalBoard(Request $request)
    {
        return $this->create([
            'title' => $request->input('title'),
            'owner_type' => User::class,
            'owner_id' => $request->user()->id,
            'private' => $request->input('private')
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createTeamBoard(Request $request)
    {
        return $this->create([
            'title' => $request->input('title'),
            'owner_type' => Team::class,
            'owner_id' => $request->input('team_id'),
            'private' => $request->input('private')
        ]);
    }

    public function editBoard($hashId)
    {
        $id = Hashids::decode($hashId);


//        return $this->find(Hashids::decode($hashId));


        return $this->entity->with([
            'columns' => function ($column) {
                $column->select('id', 'board_id', 'title', 'order')
                    ->with([
                        'cards' => function ($card) {
                            $card->select('id', 'column_id', 'title', 'description', 'order');
                        }
                    ]);
            }
        ])->findOrFail($id)->first();
    }
}