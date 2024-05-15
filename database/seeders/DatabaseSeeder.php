<?php

namespace Database\Seeders;

use App\Models\MainData;
use App\Models\MappingData;
use App\Models\MatchingData;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         MainData::factory(10)->create();
         MappingData::factory(10)->create();
         $this->call(MatchingDataSeeder::class);
    }
}
