<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $professions = [
            'android' => 'Android',
            'vue' => 'Vue.js',
            'react' => 'React.js',
            'php' => 'PHP',
            'java' => 'Java',
            'python' => 'Python'
        ];

        foreach ($professions as $key => $name) {
            $profession = Profession::create(['name' => $name]);

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
        }
    }
}


