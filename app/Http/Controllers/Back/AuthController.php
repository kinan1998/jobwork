<?php

namespace App\Http\Controllers\Back;

use App\Models\Otp;
use App\Models\City;
use App\Mail\OtpMail;
use App\Models\Company;
use App\Models\Scope_work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Scope;

class AuthController extends Controller
{
    public function createOtp(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $company = Company::where('phone', $request->phone)
                            ->Where('email', $request->email)
                            ->first();
        if (!$company) {
            return back()->withErrors(['password' => __('route.This phone or email is not there')]); 
        }

            Otp::where('phone', $request->phone)
            ->where('email', $request->email)
            ->delete();

        $otp = new Otp();  
        $otp->phone = $request->phone; 
        $otp->email = $request->email; 
        $otp->generateCode(); 

        $this->otpwhatsapp($request, $otp->code);

        Mail::to($request->email)->send(new OtpMail($otp->code ,$company->name_company));
        
        session(['phone' => $request->phone, 'email' => $request->email]);

       
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

    public function Register()
    {
        $city = City::get();
        $scopeWorks = Scope_work::all();
        return view('back.auth.Register',compact('city','scopeWorks'));
    }

    public function Registerform (Request $request){
        $request->validate([
            'name_company' => 'required|max:255|unique:companies,name_company',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:10|min:10|unique:companies,phone',
            'email' => 'required|max:255|email|unique:companies,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'job_title' => 'required|max:255',
            'city_id' => 'required',
            'scopeWorks_id' => 'required',
            'scopeWorks_id.*' => 'exists:scope_works,id',
        
        ]);

        try {

            $data = $request->only([
              'name_company',
              'first_name',
              'last_name',
              'phone',
              'email',
              'password',
              'job_title',
              'city_id',
              'address',
            ]);
         
            $data['password'] = Hash::make($request->password);
            $data['type'] ='admin';

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('images');
                $file->move($destinationPath, $fileName);
                $data['image'] = 'images/' . $fileName;
            }

            $Company = Company::create($data);

          
            $Company->scopeWorks()->attach($request->scopeWorks_id);
            
            $this->createOtp($request);
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->route('verifeyOtpPage');

        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }

    }


    public function login()
    {
        return view('back.auth.login');
    }


    
    public function LoginForm(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required|string',
        ]);
    
        $credentials = ['password' => $request->password];
        $input = $request->email_or_phone;
    
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $input;
            $Company = Company::where('email', $input)->first();
        } else {
            $credentials['phone'] = $input;
            $Company = Company::where('phone', $input)->first();
        }
    
        if ($Company) 
        {
            if ($Company->active == 1) 
            {
                if (Auth::guard('company')->attempt($credentials)) {
                    toastr()->success(trans('route.Welcome back Mr') . " "  .$Company->first_name);
                    return redirect()->intended('dashboard');
                } else {
                    return back()->withErrors(['password' => __('route.incorrect_password')]);
                }
            } else {
                return back()->withErrors(['email_or_phone' => __('route.account_not_active')]);
            }
        } else {
            return back()->withErrors(['email_or_phone' => __('route.no_account_found')]);
        }
    }
    


    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect('/');
    }

    public function forgetPassword(){
        return view('back.auth.forgetPassword');
    }
}
