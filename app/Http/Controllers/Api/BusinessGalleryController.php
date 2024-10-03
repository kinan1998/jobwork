<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\BusinessGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusinessGalleryController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        $BusinessGallerys = BusinessGallery::where('user_id',auth()->user()->id)->get();
        return $this -> returnData('BusinessGallerys',$BusinessGallerys);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items.*.name' => 'required|string|max:255', 
            'items.*.link' => 'required|string', 
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }
    
        foreach ($request->input('items') as $item) {
            $BusinessGallery = new BusinessGallery();
            $BusinessGallery->name = $item['name'];
            $BusinessGallery->link = $item['link'];
            $BusinessGallery->user_id = Auth::id();
            $BusinessGallery->save();
        }
    
        return $this->returnSuccessMessage('User BusinessGallery created successfully');
    }
    


    public function update(Request $request ,$id )
    {
        $BusinessGallerys = BusinessGallery::find($id);
            
        if(!$BusinessGallerys)
            return $this->returnError('User BusinessGallery not found');

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'link' => 'sometimes|required|string',
            ]);
        
            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->all();
                return response()->json($errors, 401);
            }

            $BusinessGallerys->update($request->only([
                'name', 
                'link', 
            ]));
         
        return $this->returnSuccessMessage('User BusinessGallery updated successfully');

    }


    public function destroy($id)
    {
        $BusinessGallerys = BusinessGallery::find($id);
            
            if(!$BusinessGallerys)
                return $this->returnError('User BusinessGallery not found');
            
        $BusinessGallerys->delete();
        return $this->returnSuccessMessage('User BusinessGallery deleted successfully');
    }
}
