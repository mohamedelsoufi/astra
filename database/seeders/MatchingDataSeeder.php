<?php

namespace Database\Seeders;

use App\Models\MatchingData;
use Illuminate\Database\Seeder;

class MatchingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MatchingData::create(['arabic_description' => 'Sample Arabic 1', 'english_description' => 'Sample English 1', 'latin_description' => 'Sample Latin 1']);
        MatchingData::create(['arabic_description' => 'Sample Arabic 2', 'english_description' => 'Sample English 2', 'latin_description' => 'Sample Latin 2']);
        MatchingData::create(['arabic_description' => 'Sample Arabic 3', 'english_description' => 'Sample English 3', 'latin_description' => 'Sample Latin 3']);
    }
}
