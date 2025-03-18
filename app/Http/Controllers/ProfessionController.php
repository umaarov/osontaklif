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

        $response = Http::withHeaders([
            'User-Agent' => 'OsonTaklif (hs.umarov21@gmail.com)',
        ])->get("https://api.hh.uz/vacancies", [
            'text' => $searchQuery,
            'area' => '113',
            'per_page' => 50,
        ]);

        if ($response->failed()) {
            dd($response->json());
        }

        $vacancies = $response->json()['items'] ?? [];
        $skillsCount = [];

        foreach ($vacancies as $vacancy) {
            $details = Http::withHeaders([
                'User-Agent' => 'MyApp (your-email@example.com)',
            ])->get($vacancy['url'])->json();

            // Extract key skills
            if (!empty($details['key_skills'])) {
                foreach ($details['key_skills'] as $skill) {
                    $skillName = strtolower($skill['name']);
                    $skillsCount[$skillName] = ($skillsCount[$skillName] ?? 0) + 1;
                }
            }

            // Extract from description
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
