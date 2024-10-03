<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = []; 


    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    
    public function jobOpportunities()
    {
        return $this->hasMany(JobOpportunity::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($subscripy) {

            $subscripy->jobOpportunities()->delete();
        });
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
