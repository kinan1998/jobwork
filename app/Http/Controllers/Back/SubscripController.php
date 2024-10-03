<?php

namespace App\Http\Controllers\Back;

use App\Models\Plan;
use App\Models\Company;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscripController extends Controller
{
    public function index()
    {   
        $plans = Plan::get();
        $Subscription = Subscription::orderBy('id', 'DESC')->get();
        $companys = Company::get();
        return view('back.subscrip.index',compact('Subscription','plans','companys'));
    }



    public function store(Request $request)  {
        $request->validate([
            'plan_id' => 'required',
            'company_id' =>'required',
            'payment_type' => 'required',
            'name' => 'required',
            'By' => 'required_if:payment_type,تحويل',
            'id_payment' => 'required_if:payment_type,تحويل',
        ]);
        
        try {

            $Subscription = new Subscription();
            $Subscription->name = $request->name;
            $Subscription->plan_id = $request->plan_id;
            $Subscription->payment_type = $request->payment_type;
            $Subscription->company_id = $request->company_id;

            $Subscription->By = $request-> By;
            $Subscription-> id_payment  = $request-> id_payment ;
            
            $Subscription->status = 'In Processing ';
            $Subscription->save();
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->back();
            
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }
    }

    public function show( $id){
      
        $Subscription = Subscription::find($id);
     
        $getid = DB::table('notifications')->where('data->subscription_id',$id)->pluck('id');
        
        DB ::table('notifications')->where('id', $getid)->update(['read_at'=>now()]);
        
        return view ('back.subscrip.show',compact('Subscription'));
    }

    public function Unacceptable($id){
        $Subscription = Subscription::find($id);
        $Subscription->status = 'Unacceptable';
        $Subscription->save();
        toastr()->warning(trans('route.Update_messages'));
        return redirect()->back();
    }

    public function Acceptable($id){
        $Subscription = Subscription::find($id);
        $Subscription->status = 'Acceptable';
        $Subscription->save();
        toastr()->warning(trans('route.Update_messages'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $Subscription = Subscription::find($id);
        $Subscription->delete();
        toastr()->error(trans('route.Delete_messages'));

        return redirect()->back();
    }
}
