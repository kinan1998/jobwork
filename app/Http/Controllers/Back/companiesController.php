<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Scope_work;

class companiesController extends Controller
{
    public function index()
    {
        $companies = Company::where('id', '!=', auth()->guard('company')->user()->id)->get();
        return view('back.companies.index', compact('companies'));
    }

    public function show($id){
        $city = City::get();
        $company =Company::findOrFail($id);
        $scopeWorks = Scope_work::all();
        return view('back.companies.show', compact('company','scopeWorks','city'));
    }

    public function updateActiveStatus(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->active = $request->input('active');
        $company->save();

     
       
      
        return response()->json(['success' => 'company status updated successfully']);
    }
}
