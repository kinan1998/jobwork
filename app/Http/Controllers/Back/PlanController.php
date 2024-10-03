<?php

namespace App\Http\Controllers\Back;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('back.plans.index', compact('plans'));
    }

    public function store(Request $request)
    {
  
        $request->validate([
            'Number_of_opportunities' => 'required|integer',
            'price' => 'required|integer',
        ]);
        try {

            $plan = new Plan();
            $plan->Number_of_opportunities = $request->Number_of_opportunities;
            $plan->price = $request->price;
            $plan->save();
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
            $plan = Plan::findOrFail($id);
            
            $request->validate([
                'Number_of_opportunities' => 'required|integer',
                'price' => 'required|integer',
            ]);
    
            $plan->update([
                'Number_of_opportunities' => $request->Number_of_opportunities,
                'price' => $request->price,
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
        $plan =Plan::findOrFail($id)->delete();
        toastr()->error(trans('route.Delete_messages'));
        return redirect()->back();
    }
}
