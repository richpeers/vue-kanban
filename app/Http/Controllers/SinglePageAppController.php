<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SinglePageAppController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('index');
    }
}
