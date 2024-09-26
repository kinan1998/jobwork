<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    protected $guarded = []; 


    // public function resetCode(){
    //     $this->timestamps = false;
    //     $this->code =null;
    //     $this->expires_at =null;
    //     $this->save();
    // }

    public function generateCode(){
        $this->timestamps = false;  
        $this->code = rand(1000, 9999); 
        $this->expires_at = now()->addMinute(5);  
        $this->save();
    }
}
