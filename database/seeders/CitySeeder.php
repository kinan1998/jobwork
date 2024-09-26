<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->truncate();

        $cities = [
            [
                
                'name_en' => 'Damascus',
                'name_ar' => 'دمشق',
            ],
            [
                'name_en' => 'Homs',
                'name_ar' => 'حمص',
            ],
            [
                'name_en' => 'Latakia',
                'name_ar' => 'لاذقية',
            ],
            [
                'name_en' => 'Hama',
                'name_ar' => 'حماة',
            ],
            [
                'name_en' => 'Aleppo',
                'name_ar' => 'حلب',
            ],
            [
                'name_en' => 'Tartous',
                'name_ar' => 'طرطوس',
            ]
                
                
        
        ];

        foreach ($cities as $City) {

            City::create($City);
        }
    }
}
