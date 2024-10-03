<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPlanController extends Controller
{
    public function index()
    {   $plans = Plan::all();
         return view('admin.plan.index',compact('plans'));
    }


}
