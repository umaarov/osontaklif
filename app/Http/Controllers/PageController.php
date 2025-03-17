<?php

namespace App\Http\Controllers;

use App\Models\Profession;

class PageController extends Controller
{
    public function home()
    {
        $professions = Profession::all();
        return view('pages.home', compact('professions'));
    }

    public function profession($name)
    {
        $profession = Profession::where('name', $name)->firstOrFail();
        $questions = $profession->questions;

        return view('pages.profession', compact('profession', 'questions'));
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
