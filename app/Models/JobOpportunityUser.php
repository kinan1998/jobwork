<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpportunityUser extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function user(){
        return $this->belongsTo(User::class);
    }  

    public function jobopportunity(){
        return $this->belongsTo(JobOpportunity::class);
    }  

}
