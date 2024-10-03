<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExperiencesController extends Controller
{ 
    use GeneralTrait;
    
    public function index()
    {
        $experiences = Experience::where('user_id',auth()->user()->id)->with('jobtitle')
        ->get();
        $experiences->transform(function($experience) {
            if(app()->getLocale() == 'ar')
            { 
                $experience->job_title_id = $experience->jobtitle->name_ar;
                unset($experience->jobtitle);
            }

            else
            {
                $experience->job_title_id = $experience->jobtitle->name_en;
                unset($experience->jobtitle);
            }
            return $experience;
        });
        return $this -> returnData('Experience',$experiences);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_company' => 'required|string|max:255', 
            'from_date' => 'required|date_format:Y-m-d', 
            'to_date' => 'required|date_format:Y-m-d|after:from_date', 
       
            'text' => 'required|string',
            'job_title_id' =>'required|exists:job__titles,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $Experience = new Experience();
        $Experience->name_company = $request->name_company;
        $Experience->from_date = $request->from_date;
        $Experience->to_date = $request->to_date; 
        $Experience->text = $request->text; 
        $Experience->job_title_id = $request->job_title_id;
        $Experience->user_id = Auth::id(); 
        $Experience->save();
        return $this -> returnSuccessMessage('User Experience Created Successfully');
    }

    public function update(Request $request ,$id )
    {
        $Experience = Experience::find($id);
            
        if(!$Experience)
            return $this->returnError('User Experience not found');

        $validator = Validator::make($request->all(), [
            'name_company' => 'sometimes|required|string|max:255', 
            'from_date' => 'sometimes|required|date_format:Y-m-d', 
            'to_date' => 'sometimes|required|date_format:Y-m-d|after:from_date', 
            'text' => 'sometimes|required|string',
            'job_title_id' =>'sometimes|required|exists:job__titles,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $Experience->update($request->only([
            'name_company', 
            'from_date',
            'to_date', 
            'text',
            'job_title_id', 
             
        ]));
        return $this -> returnSuccessMessage('User Experience Updated Successfully');
    }

    public function destroy($id)
    {
        $Experience = Experience::find($id);
            
            if(!$Experience)
                return $this->returnError('User Experience not found');
            
        $Experience->delete();
        return $this->returnSuccessMessage('User Experience deleted successfully');
    }
}
