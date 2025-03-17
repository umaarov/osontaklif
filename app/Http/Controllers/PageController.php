<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    final function home(): object
    {
        return view('pages.home');
    }

    final function mock(): object
    {
        return view('pages.mock');
    }

    final function requirements(): object
    {
        return view('pages.requirements');
    }
}
