<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Question;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AndroidQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        $professionName = 'Android';
        $csvPath = database_path('seeders/data/android_interview_questions.csv');
        $htmlContentDir = database_path('seeders/data/question_content');

        $this->command->info("Starting Android Questions Seeder...");
        $this->command->info("CSV Path: {$csvPath}");
        $this->command->info("HTML Content Directory: {$htmlContentDir}");

        if (!File::isDirectory($htmlContentDir)) {
            $this->command->error("FATAL: HTML Content directory not found or is not a directory at: {$htmlContentDir}");
            $this->command->error("Please ensure the 'question_content' folder exists inside 'database/seeders/data/'");
            return;
        } else {
            $this->command->info("HTML Content directory found.");
        }


        $profession = Profession::where('name', $professionName)->first();
        if (!$profession) {
            $this->command->error("Profession '{$professionName}' not found. Please seed professions first or adjust the name.");
            return;
        }
        $professionId = $profession->id;
        $this->command->info("Found Profession '{$professionName}' with ID: {$professionId}");

        if (!File::exists($csvPath)) {
            $this->command->error("CSV file not found at: {$csvPath}");
            return;
        }

        $fileHandle = fopen($csvPath, 'r');
        if (!$fileHandle) {
            $this->command->error("Could not open CSV file: {$csvPath}");
            return;
        }

        $header = true;
        $totalRows = 0;
        $seededCount = 0;
        $skippedCount = 0;
        $contentErrors = 0;
        $tagErrors = 0;

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($fileHandle)) !== false) {
                if ($header) {
                    $header = false;
                    continue;
                }

                $totalRows++;

                if (count($row) < 4) {
                    $this->command->warn("Skipping invalid row #{$totalRows} (not enough columns): " . implode(',', $row));
                    $skippedCount++;
                    continue;
                }

                $sourceId = trim($row[0]);
                $questionText = trim($row[1]);
                $chance = is_numeric(trim($row[2])) ? (int)trim($row[2]) : 0;
                $rawTag = trim($row[3]);

                if (empty($sourceId) || !ctype_digit($sourceId)) {
                    $this->command->warn("Skipping row #{$totalRows} due to invalid or empty Source ID: '{$sourceId}'");
                    $skippedCount++;
                    continue;
                }
                if (empty($questionText)) {
                    $this->command->warn("Skipping row #{$totalRows} (Source ID: {$sourceId}) due to empty question text.");
                    $skippedCount++;
                    continue;
                }

                $tag = ($rawTag === 'Нет' || $rawTag === '') ? null : $rawTag;

                if ($rawTag !== 'Нет' && $rawTag !== '' && $tag === null) {
                    $this->command->warn("Potential issue processing tag for Source ID {$sourceId}. Raw: '{$rawTag}', Processed: NULL");
                    $tagErrors++;
                }

                $htmlFileName = 'question_' . $sourceId . '.html';
                $htmlFilePath = rtrim($htmlContentDir, '/') . '/' . $htmlFileName;
                $content = null;

                if (File::exists($htmlFilePath)) {
                    if (is_readable($htmlFilePath)) {
                        try {
                            $content = File::get($htmlFilePath);
                            if (empty(trim($content))) {
                                $this->command->warn("Content file found but is empty for Source ID {$sourceId}: {$htmlFilePath}");
                            } else {
                            }
                        } catch (Exception $e) {
                            $this->command->error("Error reading content file for Source ID {$sourceId}: {$e->getMessage()}");
                            $contentErrors++;
                        }
                    } else {
                        $this->command->warn("Content file exists but is not readable (check permissions) for Source ID {$sourceId}: {$htmlFilePath}");
                        $contentErrors++;
                    }
                } else {
                    $this->command->warn("HTML content file not found for Source ID {$sourceId}: {$htmlFilePath}");
                    $contentErrors++;
                }

                Question::updateOrCreate(
                    [
                        'profession_id' => $professionId,
                        'question' => $questionText,
                    ],
                    [
                        'content' => $content,
                        'chance' => $chance,
                        'tag' => $tag,
                    ]
                );

                $seededCount++;

            }

            DB::commit();
            $this->command->info("----------------------------------------");
            $this->command->info("Seeding Complete!");
            $this->command->info("Total CSV data rows processed: {$totalRows}");
            $this->command->info("Questions seeded/updated in DB: {$seededCount}");
            $this->command->info("Rows skipped due to validation errors: {$skippedCount}");
            $this->command->info("Issues finding/reading content files: {$contentErrors}");
            if ($tagErrors > 0) {
                $this->command->warn("Potential issues detected during tag processing: {$tagErrors}");
            }
            $this->command->info("----------------------------------------");


        } catch (Exception $e) {
            DB::rollBack();
            $this->command->error("An error occurred during seeding: " . $e->getMessage());
            Log::error("AndroidQuestionsSeeder failed: " . $e->getMessage() . "\n" . $e->getTraceAsString());
        } finally {
            if ($fileHandle) {
                fclose($fileHandle);
            }
        }
    }
}
