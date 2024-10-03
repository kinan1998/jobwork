<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CertificatesController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        $certificates = Certificate::where('user_id', auth()->user()->id)->get();
        $certificates->transform(function ($certificate) {
            $certificate->image = asset($certificate->image);
            return $certificate;
        });
        return $this->returnData('Certificate', $certificates);
    }


    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certificate_type' => 'required|string|max:255', 
            'certificate_name' => 'required|string|max:255', 
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);  
        }

        $data = $request->only([
            'certificate_type', 
            'certificate_name', 
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            $data['image'] = 'images/' . $fileName;
        }

        $data['user_id'] = Auth::id();
   
        Certificate::create($data);
        return $this->returnSuccessMessage('User Certificate created successfully');

    }


    public function update(Request $request ,$id)
    {
        $certificates = Certificate::find($id);
            
        if(!$certificates)
            return $this->returnError('User Certificate not found');

       

        $validator = Validator::make($request->all(), [
            'certificate_type' => 'required|string|max:255', 
            'certificate_name' => 'required|string|max:255', 
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }

        $data = $request->only([
            'certificate_type', 
            'certificate_name', 
        ]);

      
        if ($request->hasFile('image')) {
            if ($certificates->image && file_exists(public_path($certificates->image))) {
                unlink(public_path($certificates->image));
            }

            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            $data['image'] = 'images/' . $fileName;
        }

        $certificates->update($data);

        return $this->returnSuccessMessage('User updated successfully');
    }


    public function destroy($id)
    {
        $Certificate = Certificate::find($id);
            
            if(!$Certificate)
                return $this->returnError('User Certificate not found');


        if ($Certificate->image && file_exists(public_path($Certificate->image))) {
            unlink(public_path($Certificate->image));
        }    
        $Certificate->delete();
        return $this->returnSuccessMessage('User Certificate deleted successfully');
    }

}
