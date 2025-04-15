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
            'Frontend',
            'DevOps',
            'CSharp',
            'C++',
            'Golang',
            'SQL',
            'Quality Assurance',
            'Project Manager',
        ];

        foreach ($professions as $name) {
            Profession::create(['name' => $name]);
        }
    }
}
