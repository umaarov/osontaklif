<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\Profession;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    final function run(): void
    {
        $professions = [
            'java' => 'Java',
            'python' => 'Python',
            'php' => 'PHP',
            'android' => 'Android',
            'ios' => 'iOS',
            'flutter' => 'Flutter',
            'node' => 'Node.js',
            'react' => 'React',
            'vue' => 'Vue',
            'html-css' => 'HTML & CSS',
            'devops' => 'DevOps',
            'csharp' => 'CSharp',
            'cpp' => 'C++',
            'js' => 'JavaScript',
            'golang' => 'Golang',
            'sql' => 'SQL',
            'qa' => 'Quality Assurance',
            'ux-ui' => 'UX & UI',
            'project' => 'Project Manager',
            'seo' => 'SEO',
        ];

        $grades = ['Junior', 'Middle', 'Senior'];

        foreach ($professions as $key => $name) {
            $profession = Profession::firstOrCreate(['name' => $name]);

            Question::create([
                'profession_id' => $profession->id,
                'question' => "What is $name?",
                'content' => "A detailed explanation of $name...",
                'chance' => rand(30, 100),
                'tag' => 'Core',
            ]);

            Question::create([
                'profession_id' => $profession->id,
                'question' => "Explain a key feature of $name.",
                'content' => "Detailed content about a feature of $name...",
                'chance' => rand(30, 100),
                'tag' => 'OOP',
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
