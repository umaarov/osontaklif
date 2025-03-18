<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Profession;
use App\Models\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    final function home(): object
    {
        $professions = Profession::all();
        return view('pages.home', compact('professions'));
    }

    final function profession($name, Request $request): object
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

    final function question($id): object
    {
        $question = Question::findOrFail($id);
        return view('pages.question', compact('question'));
    }

    final function mock(Request $request): object
    {
        $positions = Profession::all();

        $query = Interview::query()->with('profession');

        if ($request->filled('position')) {
            $query->whereHas('profession', function ($q) use ($request) {
                $q->where('id', $request->position);
            });
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        $interviews = $query->get();

        return view('pages.mock', compact('interviews', 'positions'));
    }


    final function requirements(): object
    {
        $professions = Profession::all();
        return view('pages.requirements', compact('professions'));
    }

    final function requirements_show(): object
    {
        $professions = Profession::all();
        return view('pages.requirements_show', compact('professions'));
    }
}
