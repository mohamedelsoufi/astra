<?php

namespace App\Http\Controllers;

use App\Exports\FullMAtchResultExport;
use App\Http\Requests\ImportDataRequest;
use App\Imports\DataImport;
use App\Models\MainData;
use App\Models\MappingData;
use App\Models\MatchingData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
//        return $results;

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
        $mappingData = $this->mappingData->all();

        foreach ($mappingData as $map) {
            if (stripos($description, $map->description) !== false) {
                return [
                    'mapping_data_id' => $map->id,
                    'description' => $map->description,
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
            case 1:
                return '1 out of 3 match';
            default:
                return 'No matching at all';
        }
    }

    public function extractFullMatch()
    {
        $matchingData = $this->matchingData->all();
        $results = [];

        foreach ($matchingData as $data) {
            $arabicMatch = $this->findMapping($data->arabic_description);
            $englishMatch = $this->findMapping($data->english_description);
            $latinMatch = $this->findMapping($data->latin_description);

            $matchCount = ($arabicMatch ? 1 : 0) + ($englishMatch ? 1 : 0) + ($latinMatch ? 1 : 0);
            $matchingResult = $this->getMatchingResult($matchCount);
            if ($arabicMatch && $englishMatch && $latinMatch) {
                $results[] = [
                    'id' => $data->id,
                    'arabic' => $arabicMatch,
                    'english' => $englishMatch,
                    'latin' => $latinMatch,
                    'matching_result' => $matchingResult,
                ];

            }
        }
        return Excel::download(new FullMAtchResultExport($results), 'results.xlsx');
    }

    // Insert not matched
    public function insertNotMatched()
    {
        $matchingData = $this->matchingData->all();

        foreach ($matchingData as $data) {
            $arabicMatch = $this->findMapping($data->arabic_description);
            $englishMatch = $this->findMapping($data->english_description);
            $latinMatch = $this->findMapping($data->latin_description);
            if (!$arabicMatch) {
                $this->mappingData->create([
                    'description' => $data->arabic_description,
                ]);
            }
            if (!$englishMatch) {
                $this->mappingData->create([
                    'description' => $data->english_description,
                ]);
            }
            if (!$latinMatch) {
                $this->mappingData->create([
                    'description' => $data->latin_description,
                ]);
            }
        }

        return redirect()->back()->with(['success' => 'Data Inserted Successfully']);
    }

    public function importData(ImportDataRequest $request)
    {
        try {
//            return $request;
            Excel::import(new DataImport(), $request->data);

            return redirect()->back()->with(['success' => 'Data Imported Successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
            return redirect()->back()->with(['error' => 'Something went wrong!']);
        }
    }
}
