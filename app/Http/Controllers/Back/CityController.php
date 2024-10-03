<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\back\CityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('back.cities.index',compact('cities'));
    
    }

    public function store(Request $request)
    {
  
        $request->validate([
            'name_ar' => 'required|max:255|unique:cities,name_ar',
            'name_en' => 'required|max:255|unique:cities,name_en',
        ]);
        try {

            $city = new city();
            $city->name_ar = $request->name_ar;
            $city->name_en = $request->name_en;
            $city->save();
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->back();
            
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }
    }


    public function update(Request $request, $id)
    {
        try {
            $city = city::findOrFail($id);
            
            $request->validate([
                'name_ar' => 'required|max:255|unique:cities,name_ar,' . $city->id,
                'name_en' => 'required|max:255|unique:cities,name_en,' . $city->id,
            ]);
    
            $city->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
            ]);
            
            toastr()->warning(trans('route.Update_messages'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    


    public function destroy($id)
    {
        $city =city::findOrFail($id)->delete();
        toastr()->error(trans('route.Delete_messages'));
        return redirect()->back();
    }

}
