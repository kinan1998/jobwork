<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Scope_work;

class ScopeWorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('scope_works')->truncate();

        $scope_works = [
            [
                
                'name_en' => 'programming',
                'name_ar' => 'برمجة',
                
            ],
            [
                'name_en' => 'marketing',
                'name_ar' => 'تسويق',
            ],
        
        ];

        foreach ($scope_works as $scope_work) {

            Scope_work::create($scope_work);
        }
    }
}
