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
        MatchingData::create([
            'arabic_description' => 'Sample Arabic 1',
            'english_description' => 'same desc',
            'latin_description' => 'Sample Latin 1'
        ]);
        MatchingData::create([
            'arabic_description' => 'Sample Arabic 2',
            'english_description' => 'same desc',
            'latin_description' => 'Latin'
        ]);
        MatchingData::create([
            'arabic_description' => 'نص',
            'english_description' => 'same desc',
            'latin_description' => 'Sample Latin 3'
        ]);
        MatchingData::create([
            'arabic_description' => 'نص2',
            'english_description' => 'same desc',
            'latin_description' => 'Latin'
        ]);

        MatchingData::create([
            'arabic_description' => 'نص تجريبي',
            'english_description' => 'same desc 22',
            'latin_description' => 'Sample Latin 3'
        ]);

        MatchingData::create([
            'arabic_description' => 'لوريم إيبسوم',
            'english_description' => 'lorem aliqu',
            'latin_description' => 'Latin'
        ]);
    }
}
