<?php

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\GetImageCompany;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\JobTitleController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\CVJobWorkController;
use App\Http\Controllers\Api\ScopeWorkController;
use App\Http\Controllers\Api\CompletionController;
use App\Http\Controllers\Api\UserDetailController;
use App\Http\Controllers\Api\ExperiencesController;
use App\Http\Controllers\Api\CertificatesController;
use App\Http\Controllers\Api\JobOpportunityController;
use App\Http\Controllers\Api\BusinessGalleryController;
use App\Http\Controllers\Api\JobOpportunityUserController;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;








Route::group(['middleware' => ['setapplanguage']], function () {


     ///////////////////////////// Apis Get //////////////////////////////////////

    Route::post('city', [CityController::class,'index']);
    Route::post('scope/work', [ScopeWorkController::class,'index']);
    Route::post('get/jobtitle/by/{id}', [ScopeWorkController::class,'getjobtitlebyid']);
    
    Route::post('job/title', [JobTitleController::class,'index']);



        ///////////////////////////// user Details delete //////////////////////////////////////
        Route::post('user/detail/destroy/{id}',[UserDetailController::class,'destroy']);
    


        ///////////////////////////// user create and login //////////////////////////////////////
        Route::post('register',[AuthController::class,'register']);
        Route::post('login',[AuthController::class,'login']);
 
        Route::post('verify-otp', [AuthController::class, 'verifyOtpApi']);


        Route::post('create/Otp/Phone', [OtpController::class, 'createOtpPhone']);
        Route::post('create/Otp/email', [OtpController::class, 'createOtpEmail']);
        Route::post('update/Password', [OtpController::class, 'updatePassword']);
});


Route::group(['middleware' => ['auth:sanctum','setapplanguage']], function () {

        ///////////////////////////// user Details //////////////////////////////////////
    
        Route::post('user/detail/store', [UserDetailController::class,'store']);
        Route::post('user/detail/get', [UserDetailController::class,'index']);
        Route::post('user/detail/update/{id}', [UserDetailController::class,'update']);


        ///////////////////////////// user logout //////////////////////////////////////
    
        Route::post('logout',[AuthController::class,'logout']);
        

        ///////////////////////////// user profile //////////////////////////////////////
        Route::post('user/profile',[AuthController::class,'profile']);
        Route::post('user/update',[AuthController::class,'update']);
        Route::post('user/destroy',[AuthController::class,'destroy']);


        ///////////////////////////// BusinessGallery //////////////////////////////////////
        Route::post('user/Business/Gallery/get',[BusinessGalleryController::class,'index']);
        Route::post('user/Business/Gallery/store',[BusinessGalleryController::class,'store']);
        Route::post('user/Business/Gallery/update/{id}',[BusinessGalleryController::class,'update']);
        Route::post('user/Business/Gallery/destroy/{id}',[BusinessGalleryController::class,'destroy']);


         ///////////////////////////// Skills User //////////////////////////////////////
         Route::post('user/skill/get',[SkillController::class,'index']);
         Route::post('user/skill/store',[SkillController::class,'store']);
         Route::post('user/skill/update/{id}',[SkillController::class,'update']);
         Route::post('user/skill/destroy/{id}',[SkillController::class,'destroy']);


         ///////////////////////////// Language //////////////////////////////////////

         Route::post('user/language/get',[LanguageController::class,'index']);
         Route::post('user/language/store',[LanguageController::class,'store']);
         Route::post('user/language/update/{id}',[LanguageController::class,'update']);
         Route::post('user/language/destroy/{id}',[LanguageController::class,'destroy']);


         
         ///////////////////////////// Experiences //////////////////////////////////////

         Route::post('user/Experiences/get',[ExperiencesController::class,'index']);
         Route::post('user/Experiences/store',[ExperiencesController::class,'store']);
         Route::post('user/Experiences/update/{id}',[ExperiencesController::class,'update']);
         Route::post('user/Experiences/destroy/{id}',[ExperiencesController::class,'destroy']);


         ///////////////////////////// Certificates //////////////////////////////////////

         Route::post('user/Certificates/get',[CertificatesController::class,'index']);
         Route::post('user/Certificates/store',[CertificatesController::class,'store']);
         Route::post('user/Certificates/update/{id}',[CertificatesController::class,'update']);
         Route::post('user/Certificates/destroy/{id}',[CertificatesController::class,'destroy']);



        ///////////////////////////// Cv //////////////////////////////////////

        Route::get('user/Cv/get',[CvController::class,'index']);
        
        Route::get('user/Cv/download/{id}',[CvController::class,'download']);
        Route::post('user/Cv/store',[CvController::class,'store']);
        Route::post('user/Cv/update/{id}',[CvController::class,'update']);
        Route::post('user/Cv/destroy/{id}',[CvController::class,'destroy']);

 
        ///////////////////////////// Job Opportunity //////////////////////////////////////

        Route::post('/get/all/job/Opportunity', [JobOpportunityController::class, 'index']);
        Route::post('/get/show/job/Opportunity/{id}', [JobOpportunityController::class, 'show']);
        Route::post('/get/filtter/job/Opportunity', [JobOpportunityController::class, 'filtter']);
        Route::post('/get/filterJobs', [JobOpportunityController::class, 'filterJobs']);


        
        ///////////////////////////// add Apply for a chance //////////////////////////////////////

        Route::post('/add/Apply/for/a/chance', [JobOpportunityUserController::class, 'store']);
        Route::post('/delete/Apply/for/a/chance/{id}', [JobOpportunityUserController::class, 'destroy']);
        Route::post('get/User/Opportunities',[JobOpportunityUserController::class,'getUserOpportunities']);


        


        ///////////////////////////// get Image Company //////////////////////////////////////

        Route::get('get/image/company', [GetImageCompany::class, 'getTopCompanyImages']);

        ///////////////////////////// Completion //////////////////////////////////////
        Route::get('user/completion', [CompletionController::class, 'getCompletionPercentage']);


         ///////////////////////////// Favorite //////////////////////////////////////
         Route::post('/get/Favorite/job/Opportunity', [FavoriteController::class, 'index']);

         Route::post('Favorite/store', [FavoriteController::class, 'store']);
         Route::post('Favorite/destroy/{id}',[FavoriteController::class,'destroy']);

});



        ///////////////////////////// Donlowed Pdf //////////////////////////////////////

        Route::get('/download-cv/{id}', [CVJobWorkController::class, 'download_api']);


        Route::post('sendNotification', [App\Http\Controllers\Back\JobOpportunityController::class, 'sendNotification']);

      

        Route::get('/testnotification', function () {
            $fcm = "test_khaled_mohamed_test_test"; // Replace with target device FCM token
            
            $title = "إشعار جديد";
            $description = "وصف الاختبار";
            
            // Correct path for the Google service credentials JSON file
            $credentialsFilePath = public_path('json/file.json'); // Ensure correct path
            
            // Google Client setup
            $client = new Google_Client(); // Ensure this is imported correctly
            $client->setAuthConfig($credentialsFilePath);
            $client->addScope('https://fcm.googleapis.com/fcm/send');
            $client->refreshTokenWithAssertion();
            $token = $client->getAccessToken();
            
            $access_token = $token['access_token']; // Use dynamically fetched token
            
            // Headers for HTTP request
            $headers = [
                "Authorization: Bearer key=AAAAUWfHjZ4:APA91bF4sbcRHWpgSlvhWzKxCGlymjXe3UZShjKr8Fsgw_rcriM3Q-4vEWgBgJ-3DEizZ7xf5gh6GhOkkYZARuNFozdVvN9Cg0vvFqDtmICEC-3VwMVhfarZVV5ptLKdJUE7du7AxeZJ",
                "Content-Type: application/json"
            ];
            
            // Notification data
            $data = [
                "message" => [
                    "token" => $fcm,
                    "notification" => [
                        "title" => $title,
                        "body" => $description,
                    ],
                ]
            ];
            
            $payload = json_encode($data);
        
            // cURL setup
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/YOUR_PROJECT_ID/messages:send'); // Replace with your project ID
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60); // Increase timeout
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            
            if ($err) {
                return response()->json([
                    'message' => 'Curl Error: ' . $err
                ], 500);
            } else {
                return response()->json([
                    'message' => 'Notification has been sent',
                    'response' => json_decode($response, true)
                ]);
            }
        });
        
        


