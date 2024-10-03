<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($jobTitle) {

            $jobTitle->subscriptions()->delete();
        });
    }

}
