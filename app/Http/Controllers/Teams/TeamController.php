<?php

namespace App\Http\Controllers\Teams;

use App\Domain\Teams\TeamRepository;
use App\Domain\Users\UserRepository;
use App\Http\Requests\Teams\CreateTeamFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Team as TeamResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * List teams.
     *
     * @param Request $request
     * @param UserRepository $users
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, UserRepository $users): AnonymousResourceCollection
    {
        $teams = $users->userTeamsWithBoards($request);

        return TeamResource::collection($teams);
    }

    /**
     * Store a newly created team.
     *
     * @param CreateTeamFormRequest $request
     * @return TeamResource
     */
    public function store(CreateTeamFormRequest $request): TeamResource
    {
        $team = $this->teams->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'private' => $request->input('private')
        ]);

        $this->teams->addMember($team, auth()->user()->id);

        return new TeamResource($team);
    }

    /**
     * Get a team.
     *
     * @param string $id
     * @return TeamResource
     */
    public function show(string $id): TeamResource
    {
        $team = $this->teams->findByHashId($id);

        return new TeamResource($team);
    }

    /**
     * Update a team.
     *
     * @param CreateTeamFormRequest $request
     * @param int $id
     * @return TeamResource
     */
    public function update(CreateTeamFormRequest $request, int $id): TeamResource
    {
        $team = $this->teams->update($id, [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'private' => $request->input('private')
        ]);

        return new TeamResource($team);
    }

    /**
     * Soft delete a team. (archive it)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json([
            'success' => $this->teams->delete($id)
        ], 200);
    }
}
