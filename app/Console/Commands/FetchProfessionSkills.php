<?php

namespace App\Console\Commands;

use App\Models\Profession;
use App\Services\HhService;
use Illuminate\Console\Command;

class FetchProfessionSkills extends Command
{
    protected $signature = 'skills:fetch {profession?}';
    protected $description = 'Fetch skills for professions from HeadHunter API';

    public function handle(HhService $hhService): int
    {
        $professionName = $this->argument('profession');

        if ($professionName) {
            $profession = Profession::where('name', $professionName)->first();
            if (!$profession) {
                $this->error("Profession '{$professionName}' not found.");
                return Command::FAILURE;
            }

            $this->info("Fetching skills for profession: {$profession->name}");
            $success = $hhService->fetchSkillsForProfession($profession);

            if ($success) {
                $this->info("Successfully fetched skills for {$profession->name}");
                return Command::SUCCESS;
            } else {
                $this->error("Failed to fetch skills for {$profession->name}");
                return Command::FAILURE;
            }
        } else {
            $professions = Profession::all();
            $bar = $this->output->createProgressBar(count($professions));
            $bar->start();

            $successful = 0;
            $failed = 0;

            foreach ($professions as $profession) {
                $success = $hhService->fetchSkillsForProfession($profession);

                if ($success) {
                    $successful++;
                } else {
                    $failed++;
                }

                $bar->advance();

                // Sleep to avoid hitting API rate limits
                sleep(2);
            }

            $bar->finish();
            $this->newLine();

            $this->info("Finished fetching skills for all professions");
            $this->info("Successful: {$successful}, Failed: {$failed}");

            return $failed === 0 ? Command::SUCCESS : Command::FAILURE;
        }
    }
}
