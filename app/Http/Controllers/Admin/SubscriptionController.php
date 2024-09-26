<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CreateSubscreb;
use Illuminate\Support\Facades\Notification;

class SubscriptionController extends Controller
{

    public function index()  {
        
        $subscriptions = Subscription::where('company_id',Auth::guard('company')->id())->get();
        return view('admin.subscriptions.index',compact('subscriptions'));


        // $subscriptions = Subscription::with('plan')
        // ->withCount(['jobOpportunities']) 
        // ->get();

        // foreach ($subscriptions as $subscription) {
        //     $subscription->remaining_opportunities = $subscription->plan->Number_of_opportunities - $subscription->job_opportunities_count;
        // }

    }


    public function update(Request $request, $id)
    {
        try {
            $subscription = Subscription::findOrFail($id);
            
            $request->validate([
                
                'payment_type' => 'required',
                'name' => 'required',
                'By' => 'required_if:payment_type,تحويل',
                'id_payment' => 'required_if:payment_type,تحويل',
            ]);
    
            $subscription->update([
                'payment_type'=>$request->payment_type,
                'name'=>$request->name,
                'By'=>$request->By,
                'id_payment'=>$request->id_payment,
            ]);
            
            toastr()->warning(trans('route.Update_messages'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function store(Request $request)  {
        $request->validate([
            'plan_id' => 'required',
            'payment_type' => 'required',
            'name' => 'required',
            'By' => 'required_if:payment_type,تحويل',
            'id_payment' => 'required_if:payment_type,تحويل',
            'remaining_opportunities' =>'required',
        ]);
        
        try {

            $Subscription = new Subscription();
            $Subscription->name = $request->name;
            $Subscription->plan_id = $request->plan_id;
            $Subscription->payment_type = $request->payment_type;
            $Subscription->company_id = Auth::guard('company')->id();
            $Subscription->remaining_opportunities = $request->remaining_opportunities;
            $Subscription->By = $request-> By;
            $Subscription-> id_payment  = $request-> id_payment ;
            
            $Subscription->status = 'In Processing';
            $Subscription->save();

            $owners = Company::where('type', 'owner')->get();
            Notification::send($owners, new CreateSubscreb($Subscription));
            
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->route('subscriptio.get.admin');
            
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }
    }
}
