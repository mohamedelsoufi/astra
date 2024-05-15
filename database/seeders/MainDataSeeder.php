<?php

namespace Database\Seeders;

use App\Models\MainData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MainData::create(['description' => 'same desc']);
        MainData::create(['description' => 'نص2']);
        MainData::create(['description' => 'latin']);
    }
}
