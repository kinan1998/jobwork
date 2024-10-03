<?php

namespace App\Http\Controllers\Api;

use App\Models\Cv;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CvController extends Controller
{
    use GeneralTrait;
    

    public function index()
    {
        $Cv = Cv::where('user_id',auth()->user()->id)->get();
        $Cv->transform(function ($Cv) {
            $Cv->cv = asset($Cv->cv);
            return $Cv;
        });
        return $this -> returnData('Cv',$Cv);
    }

    public function download($id)
    {
        $cv = Cv::find($id);
            if(!$cv)
                return $this->returnError('User cv not found');

        $filePath = public_path($cv->cv);
        
        if (File::exists($filePath)) {
            return response()->download($filePath);
        }
    }


      public function store(Request $request)
      {
        $validator = Validator::make($request->all(), [
            'cv' => 'required|file|mimes:pdf|max:5048',
        ]);
          if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }
        $cv = Cv::where('user_id', Auth::id())->first();

        if ($cv) {
            return $this->returnError('User cv already exist');
        }
        
        $originalFileName = $request->file('cv')->getClientOriginalName();
        $fileName = time() . '_' . preg_replace('/\s+/', '_', $originalFileName);
        $filePath = 'cvs/' . $fileName;
          
          $request->file('cv')->move(public_path('cvs'), $fileName);
  
          $cv = new Cv();
          $cv->user_id = Auth::id();
          $cv->cv = $filePath;
          $cv->save();
  
          return $this -> returnSuccessMessage('User CV Created Successfully');
         
      }


      public function update(Request $request, $id)
      {
          $cv = Cv::find($id);
            if(!$cv)
                return $this->returnError('User cv not found');

       
         
          $validator = Validator::make($request->all(), [
            'cv' => 'sometimes|file|mimes:pdf|max:5048',
        ]);
          if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }
  
          if ($request->hasFile('cv')) {
              if (File::exists(public_path($cv->cv))) {
                  File::delete(public_path($cv->cv));
              }
  
              $originalFileName = $request->file('cv')->getClientOriginalName();
              $fileName = time() . '_' . preg_replace('/\s+/', '_', $originalFileName);
              $filePath = 'cvs/' . $fileName;
              $request->file('cv')->move(public_path('cvs'), $fileName);
  
              $cv->cv = $filePath;
          }
  
          $cv->save();
          return $this -> returnSuccessMessage('User CV updated Successfully');

      }
  
      public function destroy($id)
      {
          $cv = CV::find($id);
            if(!$cv)
                return $this->returnError('User cv not found');

          if (File::exists(public_path($cv->cv))) {
              File::delete(public_path($cv->cv));
          }
  
          $cv->delete();
          return $this -> returnSuccessMessage('User CV deleted Successfully');

      }
  


}
