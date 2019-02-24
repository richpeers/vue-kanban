<?php

namespace App\Domain\Boards\Repositories;

use Illuminate\Http\Request;

interface BoardRepository
{
    public function userIndex(Request $request);

    public function createPersonalBoard(Request $request);

    public function createTeamBoard(Request $request);

    public function editBoard($hashId);
}