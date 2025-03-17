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

            Question::create(['profession_id' => $profession->id, 'question' => 'What is ' . $name . '?', 'chance' => 'High']);
            Question::create(['profession_id' => $profession->id, 'question' => 'Explain a key feature of ' . $name . '.', 'chance' => 'Medium']);
        }
    }
}

