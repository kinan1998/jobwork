<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scope_work;
use App\Http\Requests\back\Scope_workRequest;


class ScopeWorkController extends Controller
{
    public function index()
    {
        $scopeWorks = Scope_work::all();
        return view('back.scope_work.index', compact('scopeWorks'));
    }


    public function store(Scope_workRequest $request)
    {
        $request->validate([
            'name_ar' => 'required|max:255|unique:scope_works,name_ar',
            'name_en' => 'required|max:255|unique:scope_works,name_en',
        ]);
        try {

            $data = $request->only([
                'name_ar', 
                'name_en',  
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('images');
                $file->move($destinationPath, $fileName);
                $data['icon'] = 'images/' . $fileName;
            }

            $scopeWorks = Scope_work::create($data);

          
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->back();
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|max:255|unique:scope_works,name_ar,' . $id,
            'name_en' => 'required|max:255|unique:scope_works,name_en,' . $id,
        ]);

        try {
            $scopeWorks = Scope_work::findOrFail($id);
            
            $data = $request->only([
                'name_ar', 
                'name_en', 
            
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('images');
                $file->move($destinationPath, $fileName);
                $data['icon'] = 'images/' . $fileName;

                if ($scopeWorks->icon && file_exists(public_path($scopeWorks->icon))) {
                    unlink(public_path($scopeWorks->icon));
                }
            }

            $scopeWorks->update($data);

            toastr()->warning(trans('route.Update_messages'));
        
            return redirect()->back();
        }
        catch (\Exception $a) {
            return redirect()->back()->withErrors(['error' => $a->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $scopeWorks =Scope_work::findOrFail($id);
        if ($scopeWorks->icon && file_exists(public_path($scopeWorks->icon))) {
            unlink(public_path($scopeWorks->icon));
        }

        $scopeWorks->delete();

       
        toastr()->error(trans('route.Delete_messages'));
        return redirect()->back();
    }
}
