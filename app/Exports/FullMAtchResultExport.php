<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FullMAtchResultExport implements FromArray,WithMapping, WithHeadings
{
    protected $results;

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    public function array(): array
    {
        return $this->results;
    }
    public function headings(): array
    {
        return [
            "ID",
            "Arabic",
            "Table 2 ID",
            "Reason",
            "Table 1 ID",
            "English",
            "Table 2 ID",
            "Reason",
            "Table 1 ID",
            "Latin",
            "Table 2 ID",
            "Reason",
            "Table 1 ID",
        ];
    }

    public function map($row): array
    {
        return [
            $row['id'],
            $row['arabic']['description'] ?? '',
            $row['arabic']['mapping_data_id'] ?? '',
            $row['arabic']['condition_reason'] ?? '',
            $row['arabic']['main_data_id'] ?? '',
            $row['english']['description'] ?? '',
            $row['english']['mapping_data_id'] ?? '',
            $row['english']['condition_reason'] ?? '',
            $row['english']['main_data_id'] ?? '',
            $row['latin']['description'] ?? '',
            $row['latin']['mapping_data_id'] ?? '',
            $row['latin']['condition_reason'] ?? '',
            $row['latin']['main_data_id'] ?? '',
        ];
    }
}
