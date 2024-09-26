<?php

namespace App\Http\Controllers\Api;

use App\Models\skill;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        $skill = skill::where('user_id',auth()->user()->id)->get();
        return $this -> returnData('skill',$skill);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
            'Level' => 'required|string|max:255', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $skill = new skill();
        $skill->name = $request->name;
        $skill->Level = $request->Level; 
        $skill->user_id = Auth::id(); 
        $skill->save();
        return $this -> returnSuccessMessage('User Skills Created Successfully');
    }


    public function update(Request $request ,$id )
    {
        $skill = skill::find($id);
            
        if(!$skill)
            return $this->returnError('User skill not found');

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'Level' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $skill->update($request->only([
            'name', 
            'Level', 
        ]));
        return $this -> returnSuccessMessage('User Skills Updated Successfully');
    }

    public function destroy($id)
    {
        $skill = skill::find($id);
            
            if(!$skill)
                return $this->returnError('User Skill not found');
            
        $skill->delete();
        return $this->returnSuccessMessage('User Skill deleted successfully');
    }

}
