<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;
use App\Models\JobOpportunityUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JobOpportunityResource;

class FavoriteController extends Controller
{
    use GeneralTrait; 

    public function index(){

        $userId = Auth::id(); 

        $JobOpportunities = JobOpportunity::with(['user','company', 'jobtitle', 'scopework', 'city'])
            ->whereHas('favorite', function($query) use ($userId) {
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

        $existingApplication = Favorite::where('job_opportunity_id', $request->job_opportunity_id)
        ->where('user_id', Auth::id())
        ->first();

        if ($existingApplication) {
            return $this -> returnError('You have already applied for this job opportunity Favorite');

      
        }

        $favorite = new Favorite();
      
        $favorite->job_opportunity_id = $request->job_opportunity_id; 
        $favorite->user_id = Auth::id();

        $favorite->save();      
        return $this -> returnSuccessMessage('Job Opportunity  User Favorite Created Successfully');

    }

    public function destroy($id)
    {
        $favorite = Favorite::find($id);
            
            if(!$favorite)
                return $this->returnError('Job Opportunity User Favorite not found');
            
        $favorite->delete();
        return $this->returnSuccessMessage('Job Opportunity User Favorite deleted successfully');
    }
}
