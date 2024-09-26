<?php

namespace App\Http\Controllers\Api;

use App\Models\Otp;
use App\Models\User;
use App\Mail\OtpMail;
use App\Mail\OtpMailUser;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    use GeneralTrait;
    
    public function createOtpEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }
        
        $user = User::Where('email', $request->email)
                            ->first();
        if (!$user) {
            return $this->returnError('User not found !'); 
        }

            Otp::where('email', $request->email)
            ->delete();

        $otp = new Otp();  
        // $otp->phone = $request->phone; 
        $otp->email = $request->email; 
        $otp->generateCode(); 

        $this->otpwhatsapp($request, $otp->code);

        Mail::to($request->email)->send(new OtpMailUser($otp->code ,$user->first_name));
        
        
        return $this->returnSuccessMessage('OTP send successfully !');

    }

    public function createOtpPhone(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }
        
        $user = User::where('phone', $request->phone)
                            // ->Where('email', $request->email)
                            ->first();
        if (!$user) {
            return $this->returnError('User not found !'); 
        }

            Otp::where('phone', $request->phone)
            // ->where('email', $request->email)
            ->delete();

        $otp = new Otp();  
        $otp->phone = $request->phone; 
        // $otp->email = $request->email; 
        $otp->generateCode(); 

        $this->otpwhatsapp($request, $otp->code);

        // Mail::to($request->email)->send(new OtpMail($otp->code ,$company->name_company));
        
        
        return $this->returnSuccessMessage('OTP send successfully !');

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


    public function updatePassword(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }

        $user = User::where('phone', $request->phone)
                ->Where('email', $request->email)
                ->first();
                
            if (!$user) {
                return $this->returnError('User not found !');
            }
    
    
        $user->password = Hash::make($request->password);
        $user->save();

         
        return $this->returnSuccessMessage('Password updated successfully !');
      
    }
}
