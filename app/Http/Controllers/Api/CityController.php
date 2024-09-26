<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    use GeneralTrait;
    
    public function index()
    {
        $City = City::selection()->get();
        return $this -> returnData('City',$City);
    }



}
