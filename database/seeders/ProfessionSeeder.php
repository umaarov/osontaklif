<?php

use App\Models\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    final function run(): void
    {
        $professions = ['Android Developer', 'iOS Developer', 'Backend Developer'];

        foreach ($professions as $profession) {
            Profession::create(['name' => $profession]);
        }
    }
}
