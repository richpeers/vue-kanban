<?php

namespace App\Domain\Teams\Repositories;

use Illuminate\Http\Request;

interface TeamRepository
{
    public function userIndex(Request $request);

    public function addMember($team, $userId);
}