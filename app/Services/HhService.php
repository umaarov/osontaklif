<?php

namespace App\Services;

use App\Models\Profession;
use App\Models\ProfessionSkill;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class HhService
{
    private string $baseUrl = 'https://api.hh.uz/vacancies';
    private string $areasUrl = 'https://api.hh.uz/areas';
    private string $uzbekistanAreaId = '97';
    private int $perPage = 100;
    private int $maxPages = 20;

    final function fetchSkillsForProfession(Profession $profession): bool
    {
        try {
            Log::info("Starting to fetch skills for profession: {$profession->name}");

            $searchKeyword = urlencode($profession->name);
            $startTime = microtime(true);

            $uzbekistanAreas = $this->fetchUzbekistanAreas();

            if (empty($uzbekistanAreas)) {
                Log::error("No areas found for Uzbekistan. Cannot continue.");
                return false;
            }

            $filteredVacancies = [];
            $totalFound = 0;
            $totalProcessed = 0;

            for ($page = 0; $page < $this->maxPages; $page++) {
                $searchUrl = "{$this->baseUrl}?text={$searchKeyword}&per_page={$this->perPage}&page={$page}&area={$this->uzbekistanAreaId}";

                $searchResults = $this->makeApiRequest($searchUrl);

                if (!$searchResults || empty($searchResults['items'])) {
                    Log::info("No more results found or error occurred on page $page");
                    break;
                }

                if ($page === 0 && isset($searchResults['found'])) {
                    $totalFound = $searchResults['found'];
                    Log::info("Found {$totalFound} total vacancies for {$profession->name} in Uzbekistan");

                    if ($totalFound == 0) {
                        Log::info("No vacancies found in Uzbekistan regions for {$profession->name}.");
                        return false;
                    }
                }

                foreach ($searchResults['items'] as $vacancy) {
                    $totalProcessed++;

                    if (!isset($vacancy['id'], $vacancy['area']['id'], $vacancy['url'])) {
                        Log::info("Skipping vacancy with missing fields");
                        continue;
                    }

                    $areaId = $vacancy['area']['id'];

                    if ($this->isAreaInUzbekistan($areaId, $uzbekistanAreas)) {
                        $vacancyDetails = $this->fetchVacancyDetails($vacancy['id'], $vacancy['url']);

                        if ($vacancyDetails) {
                            $filteredVacancies[] = $vacancyDetails;
                        }
                    }
                }

                if ($page < $this->maxPages - 1 && $totalProcessed < $totalFound) {
                    usleep(500000);
                } else {
                    break;
                }
            }

            $skillsCount = $this->countSkills($filteredVacancies);

            $this->updateSkillsInDatabase($profession, $skillsCount);

            $executionTime = microtime(true) - $startTime;
            Log::info("Completed fetching skills for {$profession->name} in " . round($executionTime, 2) . " seconds");

            return true;

        } catch (Exception $e) {
            Log::error("Error fetching skills for profession {$profession->name}: " . $e->getMessage());
            return false;
        }
    }

    private function makeApiRequest(string $url): ?array
    {
        Log::debug("Making request to: $url");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'VacancyFetcher/1.0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // dev mode

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false || $httpCode !== 200) {
            $error = curl_error($ch);
            Log::error("API request failed: $error, HTTP code: $httpCode");
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("JSON decode error: " . json_last_error_msg());
            return null;
        }

        return $data;
    }

    private function fetchUzbekistanAreas(): array
    {
        $url = "{$this->areasUrl}/{$this->uzbekistanAreaId}";
        $areaData = $this->makeApiRequest($url);

        if (!$areaData || !isset($areaData['areas'])) {
            Log::error("Failed to fetch areas for Uzbekistan");
            return [];
        }

        $areas = [$this->uzbekistanAreaId];

        foreach ($areaData['areas'] as $area) {
            $areas[] = $area['id'];
            Log::debug("Found Uzbekistan area: " . $area['name'] . " (ID: " . $area['id'] . ")");
        }

        Log::info("Total Uzbekistan areas found: " . count($areas));
        return $areas;
    }

    private function isAreaInUzbekistan(string $areaId, array $uzbekistanAreas): bool
    {
        return in_array($areaId, $uzbekistanAreas);
    }

    private function fetchVacancyDetails(string $vacancyId, string $vacancyUrl): ?array
    {
        $vacancyData = $this->makeApiRequest($vacancyUrl);

        if (!$vacancyData) {
            Log::info("Failed to fetch details for vacancy ID: $vacancyId");
            return null;
        }

        if (!isset($vacancyData['key_skills'])) {
            Log::debug("No key skills found for vacancy ID: $vacancyId");
            return [
                'id' => $vacancyId,
                'url' => $vacancyUrl,
                'key_skills' => []
            ];
        }

        $keySkills = array_map(function ($skill) {
            return $skill['name'];
        }, $vacancyData['key_skills']);

        return [
            'id' => $vacancyId,
            'url' => $vacancyUrl,
            'key_skills' => $keySkills
        ];
    }

    private function countSkills(array $vacancies): array
    {
        $skillCount = [];

        foreach ($vacancies as $vacancy) {
            if (isset($vacancy['key_skills']) && is_array($vacancy['key_skills'])) {
                foreach ($vacancy['key_skills'] as $skill) {
                    if (!isset($skillCount[$skill])) {
                        $skillCount[$skill] = 0;
                    }
                    $skillCount[$skill]++;
                }
            }
        }

        arsort($skillCount);

        return $skillCount;
    }

    private function updateSkillsInDatabase(Profession $profession, array $skillsCount): void
    {
        ProfessionSkill::where('profession_id', $profession->id)->delete();

        $now = Carbon::now();

        foreach ($skillsCount as $skill => $count) {
            ProfessionSkill::create([
                'profession_id' => $profession->id,
                'skill_name' => $skill,
                'count' => $count,
                'last_updated' => $now
            ]);
        }

        Log::info("Updated {$profession->name} skills in database: " . count($skillsCount) . " skills");
    }
}
