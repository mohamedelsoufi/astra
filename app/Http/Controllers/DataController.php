<?php

namespace App\Http\Controllers;

use App\Models\MainData;
use App\Models\MappingData;
use App\Models\MatchingData;
use Illuminate\Http\Request;

class DataController extends Controller
{
    private MainData $mainData;
    private MappingData $mappingData;
    private MatchingData $matchingData;

    public function __construct(MainData $mainData, MappingData $mappingData, MatchingData $matchingData)
    {
        $this->mainData = $mainData;
        $this->mappingData = $mappingData;
        $this->matchingData = $matchingData;
    }


    public function match()
    {
        $columns = ['arabic_description', 'english_description', 'latin_description'];
        // Display the column selection view
        return view('matches', compact('columns'));
    }

    public function map(Request $request)
    {
        $column = $request->column;
        $matches = $this->findMatches($column);
        return view('results', compact('matches', 'column'));
    }

    public function matchResults()
    {
        $matchingData = $this->matchingData->all();
        $results = [];

        foreach ($matchingData as $data) {
            $arabicMatch = $this->findMapping($data->arabic_description);
            $englishMatch = $this->findMapping($data->english_description);
            $latinMatch = $this->findMapping($data->latin_description);

            $matchCount = ($arabicMatch ? 1 : 0) + ($englishMatch ? 1 : 0) + ($latinMatch ? 1 : 0);
            $matchingResult = $this->getMatchingResult($matchCount);

            $results[] = [
                'id' => $data->id,
                'arabic' => $arabicMatch,
                'english' => $englishMatch,
                'latin' => $latinMatch,
                'matching_result' => $matchingResult,
            ];
        }

        return view('match-results', compact('results'));
    }

    private function findMatches($column)
    {
        $matchingData = MatchingData::all();
        $mappingData = MappingData::all();
        $matches = [];

        foreach ($matchingData as $data) {
            $description = $data->{$column};

            foreach ($mappingData as $map) {
                if (stripos($description, $map->description) !== false) {
                    $matches[] = [
                        'matching_data_id' => $data->id,
                        'description' => $description,
                        'mapping_data_id' => $map->id,
                        'condition_reason' => $map->condition_reason,
                        'main_data_id' => $map->main_data_id,
                    ];
                }
            }
        }

        return $matches;
    }

    private function findMapping($description)
    {
        $mappingData = $this->matchingData->all();

        foreach ($mappingData as $map) {
            if (stripos($description, $map->description) !== false) {
                return [
                    'mapping_data_id' => $map->id,
                    'main_data_id' => $map->main_data_id,
                    'condition_reason' => $map->condition_reason,
                ];
            }
        }

        return null;
    }

    private function getMatchingResult($matchCount)
    {
        switch ($matchCount) {
            case 3:
                return 'Full match (3 out of 3)';
            case 2:
                return '2 out of 3 match';
            default:
                return 'No matching at all';
        }
    }
}
