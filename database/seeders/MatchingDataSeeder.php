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
        $arabic = ['نص تجريبي1', 'نص تجريبي2', 'نص تجريبي3', 'نص تجريبي4', 'نص تجريبي5'];
        $english = ['demo text 1', 'demo text 2', 'demo text 3', 'demo text 4', 'demo text 5'];
        $latin = ['latin demo text 1', 'latin demo text 2', 'latin demo text 3', 'latin demo text 4', 'latin demo text 5'];

        for ($m = 0; $m < count($arabic); $m++) {
            MatchingData::create([
                'arabic_description' => $arabic[$m],
                'english_description' => $english[$m],
                'latin_description' => $latin[$m],
            ]);
        }
    }
}
