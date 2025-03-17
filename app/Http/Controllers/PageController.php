<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $professions = Profession::all();
        return view('pages.home', compact('professions'));
    }

    public function profession($name, Request $request)
    {
        $profession = Profession::where('name', $name)->firstOrFail();

        $search = $request->query('search');
        $sort = $request->query('sort', 'desc');

        $questions = $profession->questions()
            ->when($search, function ($query, $search) {
                return $query->where('question', 'LIKE', "%$search%");
            })
            ->orderBy('chance', $sort)
            ->get();

        return view('pages.profession', compact('profession', 'questions', 'search', 'sort'));
    }

    public function question($id)
    {
        $question = Question::findOrFail($id);
        return view('pages.question', compact('question'));
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
