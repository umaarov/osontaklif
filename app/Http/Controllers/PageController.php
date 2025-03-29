<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Profession;
use App\Models\Question;
use App\Services\HhService;
use Carbon\Carbon;
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

    final function question($id, $profession = null): object
    {
        $question = Question::findOrFail($id);
        return view('pages.question', compact('question', 'profession'));
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

    final function requirement_show($name, HhService $hhService): object
    {
        $profession = Profession::where('name', $name)->firstOrFail();
        $search = request()->query('search');
        $sort = request()->query('sort', 'desc');

        $validatedSearch = filter_var($search, FILTER_SANITIZE_STRING);
        $validatedSort = in_array($sort, ['asc', 'desc']) ? $sort : 'desc';

        $skills = $profession->skills()
            ->when($validatedSearch, function ($query, $validatedSearch) {
                return $query->where('skill_name', 'LIKE', "%$validatedSearch%");
            })
            ->orderBy('count', $validatedSort)
            ->get();

        $needsRefresh = $skills->isEmpty() ||
            ($skills->isNotEmpty() &&
                Carbon::parse($skills->first()->last_updated)->diffInHours(now()) >= 24);

        if ($needsRefresh && !request()->ajax()) {
            dispatch(function () use ($profession, $hhService) {
                $hhService->fetchSkillsForProfession($profession);
            })->afterResponse();
        }

        $lastUpdated = $skills->isNotEmpty() ? $skills->first()->last_updated : null;

        return view('pages.requirement_show', compact('profession', 'skills', 'lastUpdated', 'needsRefresh', 'validatedSort', 'validatedSearch'));
    }
}
