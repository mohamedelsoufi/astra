<?php

namespace App\Imports;

use App\Models\MatchingData;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DataImport implements ToModel, WithHeadingRow, SkipsEmptyRows, WithValidation
{

    public function rules(): array
    {

        return [
            "arabic_description" => 'unique:matching_data,arabic_description',
            "english_description" => 'unique:matching_data,english_description',
            "latin_description" => 'unique:matching_data,latin_description',
        ];
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MatchingData([
            "arabic_description" => $row['arabic_description'],
            "english_description" => $row['english_description'],
            "latin_description" => $row['latin_description'],
        ]);
    }
}
