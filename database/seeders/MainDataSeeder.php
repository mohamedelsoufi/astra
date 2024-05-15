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
        MainData::create(['description' => 'Sample Main Data 1']);
        MainData::create(['description' => 'Sample Main Data 2']);
        MainData::create(['description' => 'Sample Main Data 3']);
    }
}
