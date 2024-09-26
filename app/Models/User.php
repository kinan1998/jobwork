<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cv;
use App\Models\City;
use App\Models\skill;
use App\Models\Language;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\BusinessGallery;
use App\Models\User_Detail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable ,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = []; 
    // protected $fillable = ['first_name','last_name'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

     
  

    public function cv()
    {
        return $this->hasOne(Cv::class);
    }

    public function userdetails()
    {
        return $this->hasOne(User_Detail::class,'user_id');
    }
    
    public function businessgallery()
    {
        return $this->hasMany(BusinessGallery::class ,'user_id');
    }
 
    public function jobopportunityuser()
    {
        return $this->belongsToMany(JobOpportunity::class, 'job_opportunity_users');
    }

    public function skill()
    {
        return $this->hasMany(skill::class ,'user_id');
    }
   
 

    public function language()
    {
        return $this->hasMany(Language::class ,'user_id');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class ,'user_id');
    }

    public function certificate()
    {
        return $this->hasMany(Certificate::class ,'user_id');
    }
    

    public function scopework()
    {
        return $this->belongsTo(Scope_work::class,'scope_work_id');
    }

    public function jobtitle()
    {
        return $this->belongsTo(Job_Title::class,'job_title_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            // Delete all related records
            $user->userdetails()->delete();
            $user->businessgallery()->delete();
            $user->skill()->delete();
            $user->language()->delete();
            $user->experience()->delete();
            $user->certificate()->delete();
            $user->cv()->delete();
            $user->jobopportunityuser()->delete();
        });
    }
 


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

 
}
