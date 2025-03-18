<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Support\Facades\Http;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::all();
        return view('pages.requirements', compact('professions'));
    }

    public function show($name)
    {
        $profession = Profession::where('name', $name)->firstOrFail();
        $searchQuery = urlencode($profession->name);

        $response = Http::get("https://api.hh.ru/vacancies", [
            'text' => $searchQuery,
            'area' => 'uz',
            'per_page' => 50,
        ]);

        if ($response->failed()) {
            return view('pages.requirements_show', [
                'profession' => $profession,
                'skills' => [],
                'error' => 'Failed to fetch data from HeadHunter',
            ]);
        }

        $vacancies = $response->json()['items'] ?? [];

        $skillsCount = [];

        foreach ($vacancies as $vacancy) {
            $details = Http::get($vacancy['url'])->json();

            if (!empty($details['key_skills'])) {
                foreach ($details['key_skills'] as $skill) {
                    $skillName = strtolower($skill['name']);
                    $skillsCount[$skillName] = ($skillsCount[$skillName] ?? 0) + 1;
                }
            }

            $description = strtolower(strip_tags($details['description'] ?? ''));

            preg_match_all('/\b[a-zA-Z0-9#.+-]+\b/', $description, $matches);
            foreach ($matches[0] as $word) {
                $skillsCount[$word] = ($skillsCount[$word] ?? 0) + 1;
            }
        }

        arsort($skillsCount);

        return view('pages.requirements_show', [
            'profession' => $profession,
            'skills' => $skillsCount,
            'error' => null
        ]);
    }

}
