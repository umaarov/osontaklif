<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\Profession;
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
            foreach ($grades as $grade) {
                Interview::create([
                    'title' => "$name Interview",
                    'link' => 'https://kun.uz',
                    'profession_id' => $profession->id,
                    'grade' => $grade,
                ]);
            }
        }
        $this->call(AndroidQuestionsSeeder::class);
        $this->command->info('All specified seeders have been run.');
    }
}
