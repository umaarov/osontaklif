<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\Profession;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $professions = [
            'android' => 'Android Developer',
            'vue' => 'Vue.js Developer',
            'react' => 'React.js Developer',
            'php' => 'PHP Developer',
            'java' => 'Java Developer',
            'python' => 'Python Developer'
        ];

        $grades = ['Junior', 'Middle', 'Senior'];

        foreach ($professions as $key => $name) {
            $profession = Profession::firstOrCreate(['name' => $name]);

            Question::create([
                'profession_id' => $profession->id,
                'question' => "What is $name?",
                'content' => "A detailed explanation of $name...",
                'chance' => rand(30, 100),
            ]);

            Question::create([
                'profession_id' => $profession->id,
                'question' => "Explain a key feature of $name.",
                'content' => "Detailed content about a feature of $name...",
                'chance' => rand(30, 100),
            ]);

            foreach ($grades as $grade) {
                Interview::create([
                    'title' => "$name Interview",
                    'link' => 'https://kun.uz',
                    'profession_id' => $profession->id,
                    'grade' => $grade,
                ]);
            }
        }
    }
}
