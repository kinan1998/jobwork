<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Scope_work;
use App\Models\Job_Title;
class ScopeWorkController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        $scope_work = Scope_work::selection()->get();
        return $this -> returnData('scope_work',$scope_work);
    }

    public function getjobtitlebyid($id)
    {
        $jobtitlebyid = Job_Title::selection()->where('scope_work_id',$id)->orderBy('id', 'DESC')->get();
        return $this -> returnData('jobtitlebyid',$jobtitlebyid);
    }


}
