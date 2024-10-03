<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use App\Models\Job_Title;
use App\Models\Scope_work;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\JobOpportunity;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Notification;
use App\Notifications\JobOpportunityAccepted;
use Kreait\Firebase\Messaging\CloudMessage;


class JobOpportunityController extends Controller
{
    public function index()
    {
        $job_opportunitys = JobOpportunity::all();
        $city = City::all();
        $scope_work = Scope_work::all();
        $job_title = Job_Title::all();
        
        return view('back.job_opportunity.index',compact('job_opportunitys','city','scope_work'));
    }

    public function getjobtitlebyid($id)
    {
        $jobtitlebyid = Job_Title::where('scope_work_id', $id)->orderBy('id', 'DESC')->get(['id', 'name_en', 'name_ar']);
        return response()->json(['jobtitlebyid' => $jobtitlebyid]);
    }

    public function create()
    {
        $city =City::get();
        $scopeWorks = Scope_work::get();
        return view('back.job_opportunity.create',compact('scopeWorks','city'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city_id' =>'required|exists:cities,id',
           
            'scope_work_id' => 'required|exists:scope_works,id',
            'job_title_id' => 'required|exists:job__titles,id',
            'gender' => 'required',
            'from_age' => ['nullable','integer','min:10','max:100','required_with:to_age','lte:to_age', ],
            'to_age' => ['nullable','integer','min:10','max:100','required_with:from_age','gte:from_age',],
            
            [
                'from_age.lte' => 'The "From Age" must be less than or equal to the "To Age".',
                'to_age.gte' => 'The "To Age" must be greater than or equal to the "From Age".',
            ],
            'educational_level' => 'required|string|max:255',
            'career_level' => 'required|string|max:255',
            'years_experience' => 'required|string|max:255',
            'number_vacancies' => 'required|integer|min:1|max:10',
            'rang_salary' => 'required|string|max:255',
            'type_job' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'job_description' => 'required|string',
            'requirements' => 'required|string',
            'requirements_for_trainees' => 'nullable|string',
            'filter'=>'nullable',
            'question'=>'nullable',
        ]);
        $company = Auth::user()->company;
        $validatedData['company_id']= Auth::id();
        $validatedData['status']= 'In Processing' ;
        $validatedData['subscription_id']= null;
        
        $jobOpportunity = new JobOpportunity($validatedData);
        $jobOpportunity->save();
        toastr()->success(trans('route.Add_messages'));

        return redirect()->route('Job.Opportunity');
    }

    public function show($id){
        $jobOpportunity = JobOpportunity::findOrfail($id);
        return view('back.job_opportunity.show',compact('jobOpportunity'));
    }

    public function filterJobs(Request $request)
    {
        $query = JobOpportunity::query();
    
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('scope_work_id')) {
            $query->where('scope_work_id', $request->scope_work_id);
        }

        if ($request->filled('job_title_id')) {
            $query->where('job_title_id', $request->job_title_id);
        }

        
        if ($request->filled('career_level')) {
            $query->where('career_level', $request->career_level);
        }
    
        if ($request->filled('type_job')) {
            $query->where('type_job', $request->type_job);
        }
    
        if ($request->filled('years_experience')) {
            $query->where('years_experience', $request->years_experience);
        }

        if ($request->filled('educational_level')) {
            $query->where('educational_level', $request->educational_level);
        }
    
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
    
    
        $jobs = $query->get();
    
        return view('back.job_opportunity.filter', compact('jobs'));
    }
    public function Unacceptable($id){
        $jobOpportunity = JobOpportunity::findOrfail($id);
        $jobOpportunity->status = 'Unacceptable';
        $jobOpportunity->save();
        toastr()->warning(trans('route.Update_messages'));
        return redirect()->back();
    }

    public function Acceptable($id){
        $jobOpportunity = JobOpportunity::findOrfail($id);
        $jobOpportunity->status = 'Acceptable';
        $jobOpportunity->save();

   


        
        toastr()->warning(trans('route.Update_messages'));
        return redirect()->back();
    }

    public function sendNotification(Request $request)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'key=AAAAUWfHjZ4:APA91bF4sbcRHWpgSlvhWzKxCGlymjXe3UZShjKr8Fsgw_rcriM3Q-4vEWgBgJ-3DEizZ7xf5gh6GhOkkYZARuNFozdVvN9Cg0vvFqDtmICEC-3VwMVhfarZVV5ptLKdJUE7du7AxeZJ', // تأكد من صحة المفتاح
        ];
    
        $body = [
            "to" => "/topics/test_khaled_mohamed_test_test",  // يمكنك تغيير التوبيك أو استخدام توكن الجهاز
            "notification" => [
                "title" => "Welcome to Lillian",
                "body" => "Welcome to Lillian"
            ]
        ];
    
        // إرسال الطلب باستخدام Laravel Http Client
        $response = Http::withHeaders($headers)->post('https://fcm.googleapis.com/fcm/send', $body);
    
        // التحقق من نجاح الطلب
        if ($response->successful()) {
            return response()->json(['status' => 'success', 'message' => 'Notification sent successfully']);
        } else {
            // عرض الرسالة الكاملة للخطأ
            return response()->json(['status' => 'error', 'message' => 'Failed to send notification: ' . $response->body()], 500);
        }        
    }

    public function edit($id)
    {
        $jobOpportunity = JobOpportunity::findOrfail($id);
        $city =City::get();
        $scopeWorks = Scope_work::get();
        return view('back.job_opportunity.edit',compact('jobOpportunity','scopeWorks','city'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'scope_work_id' => 'required|exists:scope_works,id',
            'job_title_id' => 'nullable|exists:job__titles,id',
            'gender' => 'required',
            'from_age' => ['nullable', 'integer', 'min:10', 'max:100', 'required_with:to_age', 'lte:to_age'],
            'to_age' => ['nullable', 'integer', 'min:10', 'max:100', 'required_with:from_age', 'gte:from_age'],
            'educational_level' => 'required|string|max:255',
            'career_level' => 'required|string|max:255',
            'years_experience' => 'required|string|max:255',
            'number_vacancies' => 'required|integer|min:1|max:10',
            'rang_salary' => 'required|string|max:255',
            'type_job' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'job_description' => 'required|string',
            'requirements' => 'required|string',
            'requirements_for_trainees' => 'nullable|string',
            'filter' => 'nullable',
            'question' => 'nullable',
        ], [
            'from_age.lte' => 'The "From Age" must be less than or equal to the "To Age".',
            'to_age.gte' => 'The "To Age" must be greater than or equal to the "From Age".',
        ]);

        $jobOpportunity = JobOpportunity::findOrFail($id);

        if (!$request->filled('job_title_id')) {
            $validatedData['job_title_id'] = $jobOpportunity->job_title_id;
        }

        $jobOpportunity->update($validatedData);

        toastr()->success(trans('route.Update_messages'));
        return redirect()->route('Job.Opportunity');
    }


    public function destroy($id)
    {
        $jobOpportunity =JobOpportunity::findOrFail($id);
        $jobOpportunity->delete();
        toastr()->error(trans('route.Delete_messages'));
        return redirect()->back();
    }
}
