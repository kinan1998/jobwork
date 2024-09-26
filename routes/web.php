<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CityController;
use App\Http\Controllers\Back\PlanController;
use App\Http\Controllers\Back\UsersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Api\CVJobWorkController;
use App\Http\Controllers\Back\JobtitleController;
use App\Http\Controllers\Back\SubscripController;
use App\Http\Controllers\Back\companiesController;
use App\Http\Controllers\Back\ScopeWorkController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Back\JobOpportunityController;
use App\Http\Controllers\Admin\JobOpportunityAdminController;






Route::get('/', function () {
    return view('welcome');
});




Route::post('get/jobtitle/by/{id}', [JobOpportunityController::class,'getjobtitlebyid']);

   
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){ 

        Route::get('/test/{id}', function ($id) {
            $user =App\Models\User::find($id);
            return view('cv.cv',compact('user'));
        });
        
        ////////////////////////////////// Users \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('register',[AuthController::class,'Register'])->name('Register');
        Route::post('register/form',[AuthController::class,'Registerform'])->name('Register.form');
        Route::get('login',[AuthController::class,'login'])->name('login');
        Route::post('login/form',[AuthController::class,'LoginForm'])->name('login.form');
        Route::get('forgetPassword',[AuthController::class,'forgetPassword'])->name('forgetPassword');
       
       
        /////////////////////////////////// Otp ////////////////////////////////////////
        Route::get('verifeyOtpPage',[OtpController::class,'verifeyOtpPage'])->name('verifeyOtpPage');
        Route::get('updatePasswordPage',[OtpController::class,'updatePasswordPage'])->name('updatePasswordPage');

        Route::post('create/Otp',[OtpController::class,'createOtp'])->name('create.Otp');

        Route::post('verify/otp', [OtpController::class, 'verifyOtp'])->name('verify.otp');


        Route::post('update/password', [OtpController::class, 'updatePassword'])->name('update.password');


    });
   
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:company' ]
    ], function(){ 

         
        Route::get('logout',[AuthController::class,'logout'])->name('logout');

        Route::get('/dashboard', function () {
            return view('content');
        })->name('dashboard');

        Route::get('download/CV/job/work/{id}',[CVJobWorkController::class,'download_web'])->name('download.CV.job.work');


       //////////////////////////////////  Profile \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


        Route::get('profile',[ProfileController::class,'show'])->name('profile');
        Route::post('profile/update',[ProfileController::class,'update'])->name('update.company_auth');




        ////////////////////////////////// City \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('city',[CityController::class,'index'])->name('city');
        Route::post('city/store',[CityController::class,'store'])->name('city.store');
        Route::post('city/update/{id}',[CityController::class,'update'])->name('city.update');
        Route::get('city/destroy/{id}',[CityController::class,'destroy'])->name('city.destroy');
        

        ////////////////////////////////// scope_work \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('scope/work',[ScopeWorkController::class,'index'])->name('scope_work');
        Route::post('scope/work/store',[ScopeWorkController::class,'store'])->name('scope_work.store');
        Route::post('scope/work/update/{id}',[ScopeWorkController::class,'update'])->name('scope_work.update');
        Route::get('scope/work/destroy/{id}',[ScopeWorkController::class,'destroy'])->name('scope_work.destroy');


        ////////////////////////////////// Job Title \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('job/title',[JobtitleController::class,'index'])->name('job_title');
        Route::post('job/title/store',[JobtitleController::class,'store'])->name('job_title.store');
        Route::post('job/title/update/{id}',[JobtitleController::class,'update'])->name('job_title.update');
        Route::get('job/title/destroy/{id}',[JobtitleController::class,'destroy'])->name('job_title.destroy');


        ////////////////////////////////// Users \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('users',[UsersController::class,'index'])->name('users');
        Route::get('user/show/{id}',[UsersController::class,'show'])->name('user.show');
        Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::post('/users/update-active/{id}', [UsersController::class, 'updateActiveStatus'])->name('users.updateActive');
        Route::get('/users/cv/download/{id}', [UsersController::class, 'downloadCV'])->name('cv.download');


        ////////////////////////////////// companies \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('companies',[companiesController::class,'index'])->name('companies');
        Route::get('companies/show/{id}',[companiesController::class,'show'])->name('companies.show');
        Route::post('/companies/update-active/{id}', [companiesController::class, 'updateActiveStatus'])->name('companies.updateActive');

        ////////////////////////////////// plans \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('plans',[PlanController::class,'index'])->name('plans');
        Route::post('plan/store',[PlanController::class,'store'])->name('plan.store');
        Route::post('plan/update/{id}',[PlanController::class,'update'])->name('plan.update');
        Route::get('plan/destroy/{id}',[PlanController::class,'destroy'])->name('plan.destroy');


        Route::get('subscriptio',[SubscripController::class,'index'])->name('subscriptio');
        Route::get('subscriptio/show/{id}',[SubscripController::class,'show'])->name('subscription.show');

        Route::post('subscriptio/store',[SubscripController::class,'store'])->name('subscriptio.store');
        Route::get('subscriptio/Unacceptable/{id}',[SubscripController::class,'Unacceptable'])->name('Unacceptable');
        Route::get('subscriptio/Acceptable/{id}',[SubscripController::class,'Acceptable'])->name('Acceptable');
        Route::get('subscriptio/destroy/{id}',[SubscripController::class,'destroy'])->name('subscriptio.destroy');


        //////////////////////////////////  Job Opportunity \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('Job/Opportunity',[JobOpportunityController::class,'index'])->name('Job.Opportunity');
        Route::get('Job/Opportunity/filterJobs',[JobOpportunityController::class,'filterJobs'])->name('Job.Opportunity.filter');

        Route::get('Job/Opportunity/create',[JobOpportunityController::class,'create'])->name('Job.Opportunity.create');
        Route::post('Job/Opportunity/store',[JobOpportunityController::class,'store'])->name('job_opportunity.store');
        Route::get('job/opportunity/show/{id}/job/work',[JobOpportunityController::class,'show'])->name('job_opportunity.show');

        Route::get('job/opportunity/edit/{id}/job/work',[JobOpportunityController::class,'edit'])->name('job_opportunity.edit');
        Route::post('job/opportunity/update/{id}',[JobOpportunityController::class,'update'])->name('job_opportunity.update');

        Route::get('Job/Opportunity/destroy/{id}',[JobOpportunityController::class,'destroy'])->name('job_opportunity.destroy');

        Route::get('Job/Opportunity/Unacceptable/{id}',[JobOpportunityController::class,'Unacceptable'])->name('job_opportunity.Unacceptable');

        Route::get('Job/Opportunity/Acceptable/{id}',[JobOpportunityController::class,'Acceptable'])->name('job_opportunity.Acceptable');


      
            //////////////////////////////////  Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


        Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');



        //////////////////////////////////  Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        Route::group(['prefix' => 'admin'], function () {

        ////////////////////////////////// plans Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('plans',[AdminPlanController::class,'index'])->name('plans.admin');
        
        ////////////////////////////////// Subscription Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::post('subscriptio/store',[SubscriptionController::class,'store'])->name('subscriptio.store.admin');
        Route::get('my/subscriptio',[SubscriptionController::class,'index'])->name('subscriptio.get.admin');
        Route::post('subscriptio/update/{id}',[SubscriptionController::class,'update'])->name('subscriptio.update.admin');


        ////////////////////////////////// Job Opportunity Admin \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        Route::get('my/Job/Opportunity',[JobOpportunityAdminController::class,'index'])->name('Job.Opportunity.admin');
        Route::get('create/Job/Opportunity',[JobOpportunityAdminController::class,'create'])->name('create.Job.Opportunity.admin');
        Route::post('store/Job/Opportunity',[JobOpportunityAdminController::class,'store'])->name('job_opportunity.store.admin');


        });
    });





// Route::get('/test', function () {
//     return view('content');
// });

// Route::get('/home', 'HomeController@index')->name('home');


