<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scope_work extends Model
{
    use HasFactory;
    
    protected $guarded = []; 

    public function scopeSelection($query)
    {
        return $query->select('id', 'name_' . app()->getLocale() . ' as name');
    }

    public function Job_Title(){
        return $this->hasMany(Job_Title::class, 'scope_work_id');
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'scope_work_company');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($scopeworks) {
            $scopeworks->companies()->each(function ($companies) {
                $companies->delete();
            });

            $scopeworks->user()->each(function ($user) {
                $user->delete();
            });

        
        });
    }



    

}
