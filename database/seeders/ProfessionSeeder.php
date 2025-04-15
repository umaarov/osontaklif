<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    final public function run(): void
    {
        $professions = [
            'Java',
            'Python',
            'PHP',
            'Android',
            'iOS',
            'Flutter',
            'Node.js',
            'React',
            'Vue',
            'HTML & CSS',
            'DevOps',
            'CSharp',
            'C++',
            'JavaScript',
            'Golang',
            'SQL',
            'Quality Assurance',
            'UX & UI',
            'Project Manager',
            'SEO',
        ];

        foreach ($professions as $name) {
            Profession::create(['name' => $name]);
        }
    }
}
