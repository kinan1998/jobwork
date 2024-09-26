<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Plan;
use App\Models\Scope_work;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;

class JobOpportunityAdminController extends Controller
{
    public function index()
    {
        $job_opportunitys = JobOpportunity::where('company_id', auth()->user()->id)->get();
       
        return view('admin.job_opportunity.index', compact('job_opportunitys'));
    }

    public function create()
    {
        $city =City::get();
        $scopeWorks = Scope_work::get();
        return view('admin.job_opportunity.create',compact('city','scopeWorks'));
    }

    public function store(Request $request)
    {
        $subscription = Subscription::where('company_id', Auth::user()->id)
                                    ->where('status', 'Acceptable')
                                    ->latest()
                                    ->first();
    
        if (!$subscription) {
            return redirect()->back()->withErrors(['message' => 'You do not have an Acceptable subscription.']);
        }
    
        $plan = Plan::find($subscription->plan_id);
    
        if (!$plan) {
            return redirect()->back()->withErrors(['message' => __('route.No plan associated with this subscription')]);


        }
    
        if ($subscription->remaining_opportunities == 0) {
            return redirect()->back()->withErrors(['message' => __('route.You have used all your available opportunities')]);

        }
    
        $request->validate([
            'scope_work_id' => 'required|integer|exists:scope_works,id',
            'job_title_id' => 'required|integer|exists:job__titles,id',
            'city_id' => 'required|integer|exists:cities,id',
            'gender' => 'required|string|in:male,female,Does not matter',
            'from_age' => ['nullable','integer','min:10','max:100','required_with:to_age','lte:to_age', ],
            'to_age' => ['nullable','integer','min:10','max:100','required_with:from_age','gte:from_age',],
            
            [
                'from_age.lte' => 'The "From Age" must be less than or equal to the "To Age".',
                'to_age.gte' => 'The "To Age" must be greater than or equal to the "From Age".',
            ],
            'educational_level' => 'required|string',
            'career_level' => 'required|string',
            'type_job' => 'required|string',
            'years_experience' => 'required|string',
            'number_vacancies' => 'required|integer|min:1|max:10',
            'address' => 'nullable|string',
            'rang_salary' => 'required|string',
            'job_description' => 'required|string',
            'requirements' => 'required|string',
            'requirements_for_trainees' => 'nullable|string',
        ]);
    
        $jobOpportunity = JobOpportunity::create([
            'scope_work_id' => $request->scope_work_id,
            'job_title_id' => $request->job_title_id,
            'city_id' => $request->city_id,
            'gender' => $request->gender,
            'from_age' => $request->from_age,
            'to_age' => $request->to_age,
            'educational_level' => $request->educational_level,
            'career_level' => $request->career_level,
            'years_experience' => $request->years_experience,
            'number_vacancies' => $request->number_vacancies,
            'address' => $request->address,
            'rang_salary' => $request->rang_salary,
            'job_description' => $request->job_description,
            'requirements' => $request->requirements,
            'type_job'=>$request->type_job,
            'requirements_for_trainees' => $request->requirements_for_trainees,
            'status' => 'In Processing',
            'subscription_id' => $subscription->id,
            'company_id' => Auth::user()->id,
        ]);
    
        $subscription->remaining_opportunities -= 1;
        $subscription->save();
        toastr()->success(trans('route.Add_messages'));

        return redirect()->route('Job.Opportunity.admin');
    }
    
    
}
