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
use App\Models\User_Detail;

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


    public function store(Request $request) {
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
    
    
    
        $jobOpportunity = JobOpportunity::find($request->job_opportunity_id);
        if($jobOpportunity->filter == 1){

            $userDetails = User_Detail::where('user_id', Auth::id())->first();
            if (!$userDetails) {
                return $this->returnError('The vacancy does not match your personal data');
    
            }
            
            if ($jobOpportunity->educational_level != $userDetails->educational_level) {
                return $this->returnError('Educational level does not match the job requirements');

            }
            if ($jobOpportunity->career_level != $userDetails->career_level) {
                return $this->returnError('Career level does not match the job requirements');

            }
            if ($jobOpportunity->years_experience > $userDetails->years_experience) {
                return $this->returnError('Years of experience does not match the job requirements');

            }
            if ($jobOpportunity->type_job != $userDetails->type_job) {
                return $this->returnError('Job type does not match the job requirements');

            }
            if ($jobOpportunity->gender != Auth::user()->gender) {
                return $this->returnError('Gender does not match the job requirements');
            }
            if (!is_null($jobOpportunity->from_age) && Auth::user()->age < $jobOpportunity->from_age) {
                return $this->returnError('Age is below the job requirement');
            }
            if (!is_null($jobOpportunity->to_age) && Auth::user()->age > $jobOpportunity->to_age) {
                return $this->returnError('Age exceeds the job requirement');
            }

            $jobOpportunityUser = new JobOpportunityUser();
            $jobOpportunityUser->text = $request->text;
            $jobOpportunityUser->job_opportunity_id = $request->job_opportunity_id;
            $jobOpportunityUser->user_id = Auth::id();
            $jobOpportunityUser->status = 'pending';
            $jobOpportunityUser->save();
        }
      
        $jobOpportunityUser = new JobOpportunityUser();
        $jobOpportunityUser->text = $request->text;
        $jobOpportunityUser->job_opportunity_id = $request->job_opportunity_id;
        $jobOpportunityUser->user_id = Auth::id();
        $jobOpportunityUser->status = 'pending';
        $jobOpportunityUser->save();
       
    
        return $this->returnSuccessMessage('Job Opportunity User Created Successfully');
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
