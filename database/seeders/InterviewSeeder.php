<?php

namespace Database\Seeders;

use App\Models\Interview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class InterviewSeeder extends Seeder
{
    final public function run(): void
    {
        $json = File::get(database_path('data/interviews.json'));
        $interviews = json_decode($json, true);

        foreach ($interviews as $interview) {
            Interview::create($interview);
        }
    }
}
