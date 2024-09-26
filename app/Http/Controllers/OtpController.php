<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
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

        toastr()->success(__('route.Code sent'));

        return redirect()->route('verifeyOtpPage');
    }

    public function verifeyOtpPage(Request $request){
        $phone = session('phone');
        $email = session('email');
        return view('back.auth.otp',compact('phone', 'email'));
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

    public function verifyOtp(Request $request) {
        $request->validate([
            'code' => 'required|numeric',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);
    
        $otp = Otp::where('phone', $request->phone)
                  ->where('email', $request->email)
                  ->first();
    
        if (!$otp) {
            return back()->withErrors(['otp' => __('route.No OTP found')]);
        }
    
        if ($request->code != $otp->code) {
            return back()->withErrors(['otp' => __('route.Invalid OTP')]);
        }
    
        if (now() > $otp->expires_at) {
            return back()->withErrors(['otp' => __('route.OTP expired')]);
        }
        toastr()->success(__('route.The correct code has been entered'));

        return redirect()->route('updatePasswordPage');
    }

    public function updatePasswordPage(Request $request){
        $phone = session('phone');
        $email = session('email');
        return view('back.auth.updatePassword',compact('phone', 'email'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $company = Company::where('phone', $request->phone)
                ->Where('email', $request->email)
                ->first();
                
            if (!$company) {
            return back()->withErrors(['password' => __('route.This phone or email is not there')]); 
            }
    
    
        $company->password = Hash::make($request->password);
        $company->save();

        toastr()->success(__('route.Password updated successfully'));
        return redirect()->route('login');
    }
    


}
