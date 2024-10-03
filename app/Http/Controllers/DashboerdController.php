<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Company;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;

class DashboerdController extends Controller
{

    public function index_owner() {

        $auth_allJobOpportunity=JobOpportunity::where('company_id',auth()->user()->id)->count();
        $auth_onlineJobOpportunity=JobOpportunity::where('status','=','Acceptable')->where('company_id',auth()->user()->id)->count();
        $auth_offlineJobOpportunity=JobOpportunity::where('status','=','Unacceptable')->where('company_id',auth()->user()->id)->count();
        $auth_InProcessingJobOpportunity=JobOpportunity::where('status','=','In Processing')->where('company_id',auth()->user()->id)->count();

            $auth_monthlyJobOpportunities = JobOpportunity::selectRaw('
            MONTH(created_at) as month,
            YEAR(created_at) as year,
            COUNT(*) as total,
            SUM(status = "Acceptable") as online,
            SUM(status = "Unacceptable") as offline,
            SUM(status = "In Processing") as in_processing
        ')->where('company_id',auth()->user()->id)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        $auth_months = [];
        $auth_jobStats = [];

        foreach ($auth_monthlyJobOpportunities as $data) {
            $monthName = date('F', mktime(0, 0, 0, $data->month, 1));
            $auth_months[] = $monthName;

            $auth_jobStats[$monthName] = [
                'total' => $data->total,
                'online' => $data->online,
                'offline' => $data->offline,
                'in_processing' => $data->in_processing,
            ];
        }

        $auth_sub_Acceptable  = Subscription::where('status' ,'=', 'Acceptable')->where('company_id',auth()->user()->id)->count();
        $auth_sub_InProcessing  = Subscription::where('status' ,'=', 'In Processing')->where('company_id',auth()->user()->id)->count();
        $auth_sub_Unacceptable  = Subscription::where('status' ,'=', 'Unacceptable')->where('company_id',auth()->user()->id)->count();
        $auth_sub  = Subscription::where('company_id',auth()->user()->id)->count();


        
        $allJobOpportunity=JobOpportunity::count();

        $onlineJobOpportunity=JobOpportunity::where('status','=','Acceptable')->count();

        $offlineJobOpportunity=JobOpportunity::where('status','=','Unacceptable')->count();

        $InProcessingJobOpportunity=JobOpportunity::where('status','=','In Processing')->count();

        $cities = City::withCount(['jobs' => function ($query) {
            $query->where('status', '=', 'Acceptable');
        }])->get();

        $monthlyJobOpportunities = JobOpportunity::selectRaw('
                MONTH(created_at) as month,
                YEAR(created_at) as year,
                COUNT(*) as total,
                SUM(status = "Acceptable") as online,
                SUM(status = "Unacceptable") as offline,
                SUM(status = "In Processing") as in_processing
            ')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    
        $months = [];
        $jobStats = [];
    
        foreach ($monthlyJobOpportunities as $data) {
            $monthName = date('F', mktime(0, 0, 0, $data->month, 1));
            $months[] = $monthName;
    
            $jobStats[$monthName] = [
                'total' => $data->total,
                'online' => $data->online,
                'offline' => $data->offline,
                'in_processing' => $data->in_processing,
            ];
        }
    
        $company_total = Company::where('active', '=', '1')->count();
        $user_total = User::where('active', '=', '1')->count();
    
        $sub_Acceptable  = Subscription::where('status' ,'=', 'Acceptable')->count();
        $sub_InProcessing  = Subscription::where('status' ,'=', 'In Processing')->count();
        $sub_Unacceptable  = Subscription::where('status' ,'=', 'Unacceptable')->count();
        $sub  = Subscription::count();

        return view('content', compact('months','cities', 'jobStats', 'company_total', 'user_total',
        'onlineJobOpportunity','offlineJobOpportunity','InProcessingJobOpportunity',
        'sub_Acceptable','sub_InProcessing','sub_Unacceptable','sub',
        'auth_jobStats','auth_months',
        'auth_sub_Acceptable','auth_sub_InProcessing','auth_sub_Unacceptable','auth_sub',
        'auth_allJobOpportunity', 'auth_onlineJobOpportunity', 'auth_offlineJobOpportunity', 'auth_InProcessingJobOpportunity',
        ));
    }
    
}
