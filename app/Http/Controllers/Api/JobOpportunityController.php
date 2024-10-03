<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\JobOpportunityResource;

class JobOpportunityController extends Controller
{

    use GeneralTrait;
    
    public function index()
    {
        $JobOpportunity = JobOpportunity::with(['company','jobtitle','scopework','city'])
        ->where('status' ,'Acceptable')->orderby('id','desc')->get();
        return $this -> returnData('JobOpportunity',JobOpportunityResource::collection($JobOpportunity));
    }

    public function show($id)
    {
        $JobOpportunity = JobOpportunity::with(['company','jobtitle','scopework','city'])->where('status' ,'Acceptable')->find($id);
        if(is_null($JobOpportunity)){
            return $this -> returnError('This JobOpportunity Not Found');
        }
        return $this -> returnData('JobOpportunity',new JobOpportunityResource($JobOpportunity));
    }


    public function filtter(){
        {
            $user = Auth::user();
            $userJobTitleId = $user->job_title_id;
            $userScopeWorkId = $user->scope_work_id;
    
            $jobOpportunities = JobOpportunity::with(['company', 'jobtitle', 'scopework', 'city'])
                ->where('status', 'Acceptable')
                ->where(function ($query) use ($userJobTitleId, $userScopeWorkId) {
                    $query->where('job_title_id', $userJobTitleId)
                          ->orWhere('scope_work_id', $userScopeWorkId);
                })
                ->orderByRaw('CASE 
                    WHEN job_title_id = ? THEN 1 
                    WHEN scope_work_id = ? THEN 2 
                    ELSE 3 
                END', [$userJobTitleId, $userScopeWorkId])
                ->orderBy('id', 'desc')
                ->get();
    
            return $this->returnData('JobOpportunity', JobOpportunityResource::collection($jobOpportunities));
        }
    }

    public function filterJobs(Request $request)
    {
        $query = JobOpportunity::query()->with(['company', 'jobtitle', 'scopework', 'city']);
    
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('scope_work_id')) {
            $query->where('scope_work_id', $request->scope_work_id);
        }

        if ($request->filled('job_title_id')) {
            $query->where('job_title_id', $request->job_title_id);
        }

        
        if ($request->filled('career_level')) {
            $query->where('career_level', $request->career_level);
        }
    
        if ($request->filled('type_job')) {
            $query->where('type_job', $request->type_job);
        }
    
        if ($request->filled('years_experience')) {
            $query->where('years_experience', $request->years_experience);
        }

        if ($request->filled('educational_level')) {
            $query->where('educational_level', $request->educational_level);
        }
    
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
    
    
        $jobs = $query->get();
    
        return $this->returnData('JobOpportunity', JobOpportunityResource::collection($jobs));
    }
}
