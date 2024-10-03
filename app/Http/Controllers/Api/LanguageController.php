<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        $language = Language::where('user_id',auth()->user()->id)->get();
        return $this -> returnData('language',$language);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
            'rang' => 'required|integer', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $language = new Language();
        $language->name = $request->name;
        $language->rang = $request->rang; 
        $language->user_id = Auth::id(); 
        $language->save();
        return $this -> returnSuccessMessage('User Language Created Successfully');
    }



    public function update(Request $request ,$id )
    {
        $language = Language::find($id);
            
        if(!$language)
            return $this->returnError('User language not found');

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'rang' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $language->update($request->only([
            'name', 
            'rang', 
        ]));
        return $this -> returnSuccessMessage('User language Updated Successfully');
    }

    public function destroy($id)
    {
        $language = Language::find($id);
            
            if(!$language)
                return $this->returnError('User language not found');
            
        $language->delete();
        return $this->returnSuccessMessage('User language deleted successfully');
    }

}
