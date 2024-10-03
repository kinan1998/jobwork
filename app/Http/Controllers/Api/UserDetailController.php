<?php

namespace App\Http\Controllers\Api;

use App\Models\User_Detail;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    use GeneralTrait;
    
   
    public function index()
    {
        
       $user_detail =User_Detail::where('user_id',auth()->user()->id)->get();

       return $this -> returnData('user_detail',$user_detail);
    }

   


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'rang_salary' => 'required|string|max:255',
            'status_employee' => 'required|string|max:255',
            'years_experience' => 'required|string|max:255|',
            'educational_level' => 'required|string|max:255',
            'career_level' => 'required|string|max:255',
            'type_job' => 'required|string|max:255',
           
            'description' => 'required|string|max:500',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
           
        }

        $existingDetail = User_Detail::where('user_id', Auth::id())->first();

            if ($existingDetail) {
                return $this->returnError('User details already exist');
            }

        $user_detail = new User_Detail();
        $user_detail->rang_salary = $request->rang_salary;
        $user_detail->status_employee = $request->status_employee;
        $user_detail->years_experience = $request->years_experience;
        $user_detail->educational_level = $request->educational_level;
        $user_detail->career_level = $request->career_level;
        $user_detail->type_job = $request->type_job;
       
        $user_detail->description = $request->description;
        $user_detail->user_id = Auth::id();
        $user_detail->save();

        return $this->returnSuccessMessage('User detail Create successfully');

        // return $this -> returnData('user_detail',$user_detail);
    }



    

    public function update(Request $request ,$id)
    {
        $user_detail = User_Detail::find($id);
        if (!$user_detail) {
            return $this->returnError('User details not found');
        }

        $validator = Validator::make($request->all(), [
            'rang_salary' => 'sometimes|required|string|max:255',
            'status_employee' => 'sometimes|required|string|max:255',
            'years_experience' => 'sometimes|required|string|max:255',
            'educational_level' => 'sometimes|required|string|max:255',
            'career_level' => 'sometimes|required|string|max:255',
            'type_job' => 'sometimes|required|string|max:255',
            'description' => 'string|max:500',
        

        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }
    
        
        $user_detail = User_Detail::where('user_id', Auth::id())->first();
    
        if (!$user_detail) {
            return $this->returnError('User  not found');
        }
    
        $user_detail->update($request->only([
            'rang_salary', 
            'status_employee', 
            'years_experience', 
            'educational_level', 
            'career_level', 
            'type_job', 
            'description',
        ]));
     
        
        
    
          return $this->returnSuccessMessage('User details updated successfully');
    }
    

    
    public function destroy($id)
    {
        $user_detail = User_Detail::find($id);
            
            if(!$user_detail)
                return $this->returnError('User details not found');
            
        $user_detail->delete();
        return $this->returnSuccessMessage('User details deleted successfully');
    }
     

}
    
    

