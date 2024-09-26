<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\CompanySedder;
use Database\Seeders\JobTitleSeeder;
use Database\Seeders\ScopeWorksSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      

        $this->call(ScopeWorksSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(JobTitleSeeder::class);
        $this->call(CompanySedder::class);
    }
}
