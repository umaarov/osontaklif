<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Profession;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    final public function home(): View
    {
        $professions = Profession::active()->withCount('questions')->get();
        return view('pages.home', compact('professions'));
    }

    final public function profession(Profession $profession, Request $request): View
    {
        if ($profession->questions()->count() === 0) {
            // return redirect()->route('home')->with('info', $profession->name . ' has no questions yet.');
        }

        $search = $request->query('search');
        $sort = $request->query('sort', 'desc');
        $perPage = 100;

        $questions = $profession->questions()
            ->when($search, fn($query, $search) => $query->where('question', 'LIKE', "%$search%"))
            ->orderBy('chance', $sort)
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.profession', compact('profession', 'questions', 'search', 'sort'));
    }

    final public function question(Question $question, ?string $professionSlug = null): View
    {
        $profession = null;
        if ($professionSlug) {
            $profession = Profession::where('slug', $professionSlug)->active()->first();
        }
        return view('pages.question', compact('question', 'profession'));
    }


    final public function mock(Request $request): View
    {
        $positions = Profession::active()->orderBy('name')->get();
        $perPage = 100;

        $query = Interview::query()->with('profession');

        if ($request->filled('position')) {
            $query->whereHas('profession', function ($q) use ($request) {
                $q->where('id', $request->position)->active();
            });
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        $interviews = $query->orderByDesc('created_at')->paginate($perPage)->withQueryString();

        return view('pages.mock', compact('interviews', 'positions'));
    }

    final public function requirements(): View
    {
        $professions = Profession::active()->orderBy('name')->get();
        return view('pages.requirements', compact('professions'));
    }

    final public function requirement_show(Profession $profession): View
    {
        $search = request()->query('search');
        $sort = request()->query('sort', 'desc');
        $page = request()->query('page', 1);
        $limit = request()->query('limit', 50);
        $offset = ($page - 1) * $limit;

        $validatedSearch = $search ? filter_var($search, FILTER_SANITIZE_STRING) : null;
        $validatedSort = in_array($sort, ['asc', 'desc']) ? $sort : 'desc';

        $metaRecord = $profession->skills()
            ->where('skill_name', '_total_processed')
            ->first();

        $totalProcessed = $metaRecord ? $metaRecord->count : 0;

        $skillsQuery = $profession->skills()
            ->where('skill_name', '!=', '_total_processed')
            ->when($validatedSearch, fn($query, $valSearch) => $query->where('skill_name', 'LIKE', "%$valSearch%"))
            ->orderBy('count', $validatedSort);

        $totalSkills = $skillsQuery->count();
        $skills = $skillsQuery->skip($offset)->take($limit)->get();

        $lastUpdatedSkill = $skills->sortByDesc('updated_at')->first();
        $lastUpdated = $lastUpdatedSkill ? $lastUpdatedSkill->updated_at : $profession->updated_at;

        $needsRefresh = $skills->isEmpty() || Carbon::parse($lastUpdated)->diffInHours(now()) >= 48;

        $hasMoreSkills = $totalSkills > ($offset + $limit);

        $name = $profession->name;

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

    final public function about(): View
    {
        return view('pages.about');
    }

    final public function terms(): View
    {
        return view('pages.terms');
    }

    final public function sponsorship(): View
    {
        return view('pages.sponsorship');
    }

    final public function ads(): View
    {
        return view('pages.ads');
    }
}
