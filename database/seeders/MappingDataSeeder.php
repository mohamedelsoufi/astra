<?php

namespace Database\Seeders;

use App\Models\MappingData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MappingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MappingData::create(['description' => 'Mapping Data 1', 'main_data_id' => 1, 'condition_reason' => 'A']);
        MappingData::create(['description' => 'Mapping Data 2', 'main_data_id' => 2, 'condition_reason' => 'B']);
        MappingData::create(['description' => 'Mapping Data 3', 'main_data_id' => 3, 'condition_reason' => 'C']);
    }
}