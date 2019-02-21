<?php

namespace App\Http\Controllers;

class SinglePageAppController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }
}
