<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    final public function run(): void
    {
        $this->call([
            ProfessionSeeder::class,
            InterviewSeeder::class,
            QuestionSeeder::class,
        ]);

        $this->command->info('All specified seeders have been run.');
    }

}
