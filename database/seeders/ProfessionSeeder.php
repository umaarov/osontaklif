<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{

    final public function run(): void
    {
        $professions = [
            ['name' => 'Java', 'is_active' => true],
            ['name' => 'Python', 'is_active' => true],
            ['name' => 'PHP', 'is_active' => true],
            ['name' => 'Android', 'is_active' => true],
            ['name' => 'iOS', 'is_active' => true],
            ['name' => 'Flutter', 'is_active' => true],
            ['name' => 'Node.js', 'is_active' => true],
            ['name' => 'Frontend', 'is_active' => true],
            ['name' => 'DevOps', 'is_active' => true],
            ['name' => 'CSharp', 'is_active' => false],
            ['name' => 'Golang', 'is_active' => true],
            ['name' => 'SQL', 'is_active' => true],
            ['name' => 'C++', 'is_active' => false],
            ['name' => 'Quality Assurance', 'is_active' => false],
            ['name' => 'Project Manager', 'is_active' => true],
            ['name' => 'SEO', 'is_active' => false],
        ];

        foreach ($professions as $data) {
            Profession::create([
                'name' => $data['name'],
                // 'slug' => Str::slug($data['name']),
                'is_active' => $data['is_active'],
            ]);
        }
    }
}
