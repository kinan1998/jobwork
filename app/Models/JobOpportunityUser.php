<?php

namespace App\Models;

use App\Models\JobOpportunity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOpportunityUser extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function user(){
        return $this->belongsTo(User::class);
    }  

    public function jobopportunity(){
        return $this->belongsTo(JobOpportunity::class,'job_opportunity_id');
    }  

}
