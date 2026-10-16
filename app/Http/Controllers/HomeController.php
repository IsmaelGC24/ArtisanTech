<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        return view('store.home.index')->with('viewData', $viewData);
    }
}
