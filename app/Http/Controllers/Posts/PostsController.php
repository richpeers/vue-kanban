<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'data' => 'Posts index'
        ], 200);
    }
}
