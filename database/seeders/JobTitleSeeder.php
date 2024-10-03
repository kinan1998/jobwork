<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Job_Title;
use App\Models\Scope_work;

class JobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job__titles')->truncate();

        $job__titles = [
            [
                'name_en' => 'web development',
                'name_ar' => 'تطوير مواقع',
                'scope_work_id' => Scope_work::all()->random()->id
            ],
            [
                'name_en' => 'app development',
                'name_ar' => 'تطوير تطبيقات',
                'scope_work_id' => Scope_work::all()->random()->id
            ],
        
        ];

        foreach ($job__titles as $job_title) {

            Job_Title::create($job_title);
        }
    }
}
