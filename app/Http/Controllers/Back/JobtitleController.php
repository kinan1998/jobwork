<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job_Title;
use App\Models\Scope_work;

class JobtitleController extends Controller
{
    public function index()
    {
        $scopeworks = Scope_work::all();
        $jobtitles = Job_Title::all();
        return view('back.job_title.index', compact('jobtitles','scopeworks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|max:255|unique:job__titles,name_ar',
            'name_ar' => 'required|max:255|unique:job__titles,name_en',
            'scope_work_id' => 'required',
        ]);
        try {

            $data = $request->only([
                'name_ar', 
                'name_en',
                'scope_work_id',  
            ]);

            Job_Title::create($data);
            toastr()->success(trans('route.Add_messages'));
            return redirect()->back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required|max:255|unique:job__titles,name_ar,' . $id,
            'name_en' => 'required|max:255|unique:job__titles,name_en,' . $id,
            'scope_work_id' => 'required',
        ]);

        try {
            $jobtitles = Job_Title::findOrFail($id);
            
            $data = $request->only([
                'name_ar', 
                'name_en', 
                'scope_work_id'
            ]);

            $jobtitles->update($data);

            toastr()->warning(trans('route.Update_messages'));
        
            return redirect()->back();
        }

        catch (\Exception $a) {
            return redirect()->back()->withErrors(['error' => $a->getMessage()]);
        }
     
    }


    public function destroy($id)
    {
        $jobtitles =Job_Title::findOrFail($id);
   

        $jobtitles->delete();

       
        toastr()->error(trans('route.Delete_messages'));
        return redirect()->back();
    }
}