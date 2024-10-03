<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;


    protected $guarded = []; 
    
    public function user(){
        return $this->belongsTo(User::class);
    } 
    
    public function jobtitle(){
        return $this->belongsTo(Job_Title::class,'job_title_id');
    } 
}
