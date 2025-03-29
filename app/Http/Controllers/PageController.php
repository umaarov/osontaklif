<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Profession;
use App\Models\ProfessionSkill;
use App\Models\Question;
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
        $perPage = 15; // Number of items per page

        $questions = $profession->questions()
            ->when($search, function ($query, $search) {
                return $query->where('question', 'LIKE', "%$search%");
            })
            ->orderBy('chance', $sort)
            ->paginate($perPage)
            ->withQueryString(); // This preserves other query parameters when navigating

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
        $perPage = 10; // Number of items per page

        $query = Interview::query()->with('profession');

        if ($request->filled('position')) {
            $query->whereHas('profession', function ($q) use ($request) {
                $q->where('id', $request->position);
            });
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        $interviews = $query->paginate($perPage)->withQueryString();

        return view('pages.mock', compact('interviews', 'positions'));
    }

    final function requirements(): object
    {
        $professions = Profession::all();
        return view('pages.requirements', compact('professions'));
    }

    final function requirement_show($name): object
    {
        $profession = Profession::where('name', $name)->firstOrFail();
        $search = request()->query('search');
        $sort = request()->query('sort', 'desc');
        $page = request()->query('page', 1);
        $limit = request()->query('limit', 20);
        $offset = ($page - 1) * $limit;

        $validatedSearch = filter_var($search, FILTER_SANITIZE_STRING);
        $validatedSort = in_array($sort, ['asc', 'desc']) ? $sort : 'desc';

        $metaRecord = ProfessionSkill::where('profession_id', $profession->id)
            ->where('skill_name', '_total_processed')
            ->first();

        $totalProcessed = $metaRecord ? $metaRecord->count : 0;

        $skillsQuery = $profession->skills()
            ->where('skill_name', '!=', '_total_processed')
            ->when($validatedSearch, function ($query, $validatedSearch) {
                return $query->where('skill_name', 'LIKE', "%$validatedSearch%");
            })
            ->orderBy('count', $validatedSort);

        $totalSkills = $skillsQuery->count();
        $skills = $skillsQuery->skip($offset)->take($limit)->get();

        $lastUpdated = $skills->isNotEmpty() ? $skills->first()->last_updated : null;
        $needsRefresh = $skills->isEmpty() ||
            ($skills->isNotEmpty() &&
                Carbon::parse($skills->first()->last_updated)->diffInHours(now()) >= 48);

        $hasMoreSkills = $totalSkills > ($offset + $limit);

        return view('pages.requirement_show', compact(
            'profession',
            'skills',
            'lastUpdated',
            'needsRefresh',
            'validatedSort',
            'validatedSearch',
            'totalProcessed',
            'page',
            'limit',
            'totalSkills',
            'hasMoreSkills',
            'name'
        ));
    }
}
