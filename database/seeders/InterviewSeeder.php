<?php

use Illuminate\Database\Seeder;
use App\Models\Interview;
use App\Models\Profession;

class InterviewSeeder extends Seeder
{
    final function run(): void
    {
        $android = Profession::where('name', 'Android Developer')->first();
        $ios = Profession::where('name', 'iOS Developer')->first();

        Interview::insert([
            ['title' => 'Android Interview #1', 'link' => 'https://kun.uz', 'profession_id' => $android->id, 'grade' => 'Junior'],
            ['title' => 'iOS Technical Interview', 'link' => 'https://kun.uz', 'profession_id' => $ios->id, 'grade' => 'Middle'],
            ['title' => 'Senior Android Interview', 'link' => 'https://kun.uz', 'profession_id' => $android->id, 'grade' => 'Senior'],
        ]);
    }
}
