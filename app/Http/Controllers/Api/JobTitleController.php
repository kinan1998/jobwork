<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Job_Title;

class JobTitleController extends Controller
{ 
     use GeneralTrait;

    public function index()
    {
        $Job_Title = Job_Title::selection()->get();
        return $this -> returnData('Job_Title',$Job_Title);
    }
}
