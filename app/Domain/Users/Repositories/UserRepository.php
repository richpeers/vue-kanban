<?php

namespace App\Domain\Users\Repositories;

use Illuminate\Http\Request;

interface UserRepository
{
    public function userTeamsWithBoards(Request $request);
}