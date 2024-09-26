<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;
use App\Models\JobOpportunityUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JobOpportunityResource;

class JobOpportunityUserController extends Controller
{
    use GeneralTrait;
    
    public function getUserOpportunities()
    {
        $userId = Auth::id(); 

        $JobOpportunities = JobOpportunity::with(['user','company', 'jobtitle', 'scopework', 'city'])
            ->whereHas('user', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('id', 'desc') 
            ->get();
        return $this->returnData('JobOpportunity', JobOpportunityResource::collection($JobOpportunities));
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'job_opportunity_id' => 'required|exists:job_opportunities,id',
          
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $existingApplication = JobOpportunityUser::where('job_opportunity_id', $request->job_opportunity_id)
        ->where('user_id', Auth::id())
        ->first();

        if ($existingApplication) {
        return response()->json(['error' => 'You have already applied for this job opportunity'], 400);
        }

        $jobOpportunityUser = new JobOpportunityUser();
        $jobOpportunityUser->text = $request->text;
        $jobOpportunityUser->job_opportunity_id = $request->job_opportunity_id; 
        $jobOpportunityUser->user_id = Auth::id();
        $jobOpportunityUser->status = 'pending';
        $jobOpportunityUser->save();      
        return $this -> returnSuccessMessage('Job Opportunity User Created Successfully');

    }

    public function destroy($id)
    {
        $jobOpportunityUser = JobOpportunityUser::find($id);
            
            if(!$jobOpportunityUser)
                return $this->returnError('Job Opportunity User not found');
            
        $jobOpportunityUser->delete();
        return $this->returnSuccessMessage('Job Opportunity User deleted successfully');
    }
}
