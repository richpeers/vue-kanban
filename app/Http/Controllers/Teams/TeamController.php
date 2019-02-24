<?php

namespace App\Http\Controllers\Teams;

use App\Domain\Teams\Repositories\TeamRepository;
use App\Domain\Users\Repositories\UserRepository;
use App\Http\Requests\Teams\CreateTeamFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * @var TeamRepository
     */
    protected $teams;

    /**
     * TeamController constructor.
     *
     * @param TeamRepository $teams
     */
    public function __construct(TeamRepository $teams)
    {
        $this->teams = $teams;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param UserRepository $users
     * @return JsonResponse
     */
    public function index(Request $request, UserRepository $users): JsonResponse
    {
        return response()->json([
            'data' => $users->userTeamsWithBoards($request)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTeamFormRequest $request
     * @return JsonResponse
     */
    public function store(CreateTeamFormRequest $request): JsonResponse
    {
        $team = $this->teams->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'private' => $request->input('private')
        ]);

        $this->teams->addMember($team, auth()->user()->id);

        return response()->json([
            'data' => $team
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
            'data' => $this->teams->findByHashId($id)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateTeamFormRequest $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(CreateTeamFormRequest $request, $id): JsonResponse
    {
        $team = $this->teams->update($id, [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'private' => $request->input('private')
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
            'data' => $this->teams->delete($id)
        ], 200);
    }
}
