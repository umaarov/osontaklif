<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function mock()
    {
        return view('pages.mock');
    }

    public function requirements()
    {
        return view('pages.requirements');
    }
}
