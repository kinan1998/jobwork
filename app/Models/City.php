<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends Model
{
    use HasFactory;
    // use HasTranslations;

    protected $fillable = ['name_en','name_ar'];
    

    protected $table = 'cities';

    public function jobs()
    {
        return $this->hasMany(JobOpportunity::class, 'city_id');
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'name_' . app()->getLocale() . ' as name');
    }
    
}
