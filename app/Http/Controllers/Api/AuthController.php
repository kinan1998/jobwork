<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use App\Mail\OtpMailUser;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AuthController extends Controller
{

    use GeneralTrait;
    
    


    public function verifyOtpApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }
    
        if (!$request->phone && !$request->email) {
            return $this->returnError('Please provide either phone or email to verify');   
        }
    
        $query = Otp::where('code', $request->code);
    
        if ($request->phone) {
            $query->where('phone', $request->phone);
        }
    
        if ($request->email) {
            $query->where('email', $request->email);
        }
    
        $otpRecord = $query->first();
    
        if (!$otpRecord) {
            return $this->returnError('No OTP found');   
        }
    
        if (now() > $otpRecord->expires_at) {
            return $this->returnError('OTP expired');   
        }
    
        $otpRecord->delete(); 
    
        return $this->returnSuccessMessage('OTP verified successfully !');
    }
    
    public function createOtp(Request $request){
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)
                            ->Where('email', $request->email)
                            ->first();
        if (!$user) {
            return $this->returnError('This phone or email is not there');
        }

            Otp::where('phone', $request->phone)
            ->where('email', $request->email)
            ->delete();

        $otp = new Otp();  
        $otp->phone = $request->phone; 
        $otp->email = $request->email; 
        $otp->generateCode(); 

        $this->otpwhatsapp($request, $otp->code);

        Mail::to($request->email)->send(new OtpMailUser($otp->code ,$user->first_name));        
       
    }


    public function otpwhatsapp(Request $request , $otpCode){

        $message = 'Your OTP code is: ' . $otpCode;

        $params=array(
        'token' => 'bve410he1gloo0q2',
        'to' => $request->phone,
        'body' => $message,
        'priority' => '1',
        'referenceId' => '',
        'msgId' => '',
        'mentions' => ''
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance95698/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        // echo "cURL Error #:" . $err;
        } else {
        // echo $response;
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'gender' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birthday' => 'nullable|date_format:d/m/Y',
            'city_id' => 'exists:cities,id',
            'address' => 'nullable|string|max:255',
            'scope_work_id' => 'required|exists:scope_works,id',
            'job_title_id' => 'required|exists:job__titles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
           
        }
    
        $data = $request->only([
            'first_name', 
            'last_name', 
            'phone', 
            'email', 
            'gender',
            'nationality',
            'birthday',
            'city_id',
            'address',
            'scope_work_id',
            'job_title_id',
        ]);
        if ($request->filled('birthday')) {
            
            $birthday  = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
            $data['birthday'] = $birthday;
    
            $data['age'] = Carbon::parse($birthday)->age;
        }

        $data['password'] = Hash::make($request->password);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            $fileName = time() . '-' . preg_replace('/\s+/', '-', $file->getClientOriginalName());
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            
            $data['image'] = 'images/' . $fileName;
        }
    
        $user = User::create($data);
    
        $this->createOtp($request);
        return $this->returnSuccessMessage('User created successfully');
            
    }
    
    

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }

        $user = User::where('email', $request->email)->first();
       

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->returnError('There is an error in the email or password');
        }
        if($user ->active == 0){
            return $this->returnError('This account is not active');
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

     
        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        return $this->returnData('token',$token);
        
    }

    
    public function logout(Request $request)
    {
        
        auth()->user()->tokens()->delete();
        return $this->returnSuccessMessage('User successfully signed out');
    
    }


    public function profile(Request $request)
    {
        
        $user = Auth::user()->load(['city','scopework','jobtitle']);
    
        $locale = app()->getLocale();
    
        $city = $locale == 'en' ? $user->city->name_en : $user->city->name_ar;

        $scopework = $locale == 'en' ? $user->scopework->name_en : $user->scopework->name_ar;

        $jobtitle = $locale == 'en' ? $user->jobtitle->name_en : $user->jobtitle->name_ar;

        $activeStatus = $locale == 'en' &&  $user->active == 0 ? 'active' : 'مفعل';
    
        $date =[
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'gender' => $user->gender,
            'nationality' => $user->nationality,
            'birthday' => $user->birthday,
            'address' => $user->address,
            'image' => asset($user->image),
            'city' => $city,
            'scopework'=>$scopework,
            'jobtitle'=>$jobtitle,
            'active' => $activeStatus,
        ];

        return $this->returnData('profile', $date);
    
    }
    


    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'scope_work_id' => 'exists:scope_works,id',
            'job_title_id' => 'exists:job__titles,id',
            'city_id' => 'nullable|exists:cities,id',

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'gender' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birthday' => 'nullable|date_format:d/m/Y',
            'address' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }

        $data = $request->only([
            'first_name', 
            'last_name', 
            'phone', 
            'email', 
            'gender',
            'nationality',
            'birthday',
            'city_id',
            'address',
            'scope_work_id',
            'job_title_id',
        ]);

        if ($request->filled('birthday')) {
            $birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
            $data['birthday'] = $birthday;
    
            $data['age'] = Carbon::parse($birthday)->age;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->filled('scope_work_id')) {
            $data['scope_work_id'] = $request->scope_work_id;
        }

        if ($request->filled('city_id')) {
            $data['city_id'] = $request->city_id;
        }

        if ($request->filled('job_title_id')) {
            $data['job_title_id'] = $request->job_title_id;
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $file = $request->file('image');
            $fileName = time() . '-' . preg_replace('/\s+/', '-', $file->getClientOriginalName()); 
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            $data['image'] = 'images/' . $fileName;
        }

        $user->update($data);

        return $this->returnSuccessMessage('User updated successfully');
    }



    public function destroy(Request $request)
    {
        $user = User::find(auth()->id());
    
        if ($user) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            $request->user()->currentAccessToken()->delete();
    
            $user->delete();
    
            return $this->returnSuccessMessage('User deleted successfully and logged out');
        }
    
        return $this->returnError('User not found');
    }
    
    

}
