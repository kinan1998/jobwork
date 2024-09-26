<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Scope_work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $city = City::get();
        $company_auth = auth()->guard('company')->user();
        $scopeWorks = Scope_work::all();
        return view('profile.show', compact('company_auth','scopeWorks','city'));
        
    }
    public function update(Request $request)
    {
        $company_auth = auth()->guard('company')->user();

        $request->validate([
            'name_company' => 'required|max:255|unique:companies,name_company,' .$company_auth->id,
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'max:10|min:10|unique:companies,phone,'.$company_auth->id,
            'email' => 'required|max:255|email|unique:companies,email,' .$company_auth->id,
            'password' => 'string|min:6|confirmed',

            'job_title' => 'required|max:255',
            'city_id' => 'required',
            // 'scopeWorks_id' => 'required',
            'scopeWorks_id.*' => 'exists:scope_works,id',
        
        ]);

        try {

            $data = $request->only([
              'name_company',
              'first_name',
              'last_name',
              'phone',
              'email',
              'password',
              'job_title',
              'city_id',
              'address',
            ]);
       

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
    
            if ($request->filled('city_id')) {
                $data['city_id'] = $request->city_id;
            }
    
            if ($request->filled('scopeWorks_id.[]')) {
                $data['scopeWorks_id.[]'] = $request->scopeWorks_id.[];
            }
    
            if ($request->hasFile('image')) {
                if ($company_auth->image && file_exists(public_path($company_auth->image))) {
                    unlink(public_path($company_auth->image));
                }
    
                $file = $request->file('image');
                $fileName = time() . '-' . preg_replace('/\s+/', '-', $file->getClientOriginalName()); 
                $destinationPath = public_path('images');
                $file->move($destinationPath, $fileName);
                $data['image'] = 'images/' . $fileName;
            }
    
            $company_auth->update($data);
            $company_auth->scopeWorks()->sync($request->scopeWorks_id);


        toastr()->warning(trans('route.Update_messages'));

        return redirect()->back();

        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
        }
    }
}
