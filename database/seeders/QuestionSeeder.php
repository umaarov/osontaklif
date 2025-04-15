<?php

namespace Database\Seeders;

use App\Models\Profession;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class QuestionSeeder extends Seeder
{
    final public function run(): void
    {
        $questionPath = database_path('data/question');
        $contentPath = $questionPath . '/content';

        foreach (File::files($questionPath) as $file) {
            if ($file->getExtension() !== 'json') continue;

            $professionName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $profession = Profession::where('name', ucfirst($professionName))->first();

            if (!$profession) {
                $this->command->warn("Profession not found: $professionName");
                continue;
            }

            $questions = json_decode(File::get($file->getRealPath()), true);

            if (!is_array($questions)) {
                $this->command->warn("Invalid or empty JSON in: {$file->getFilename()}");
                continue;
            }

            foreach ($questions as $q) {
                $contentFilePath = $contentPath . '/question_' . $q['id'] . '.html';

                $content = File::exists($contentFilePath)
                    ? File::get($contentFilePath)
                    : '';

                $tags = isset($q['tags']) && is_array($q['tags']) ? implode(',', $q['tags']) : ($q['tag'] ?? null);

                Question::create([
                    'profession_id' => $profession->id,
                    'question' => $q['question'],
                    'content' => $content,
                    'chance' => $q['chance'] ?? 0,
                    'tag' => $tags,
                ]);
            }

            $this->command->info("Seeded questions for: {$professionName}");
        }
    }
}
