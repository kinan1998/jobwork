<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->truncate();

        $companys = [
            [
                'name_company' => 'findJob',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'phone' => '0962812838',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'job_title' => 'Owner',
                'city_id' =>City::all()->random()->id,
                'type' => 'owner',
            ],
                     
        ];

        foreach ($companys as $Company) {

            Company::create($Company);
        }
    }
}
