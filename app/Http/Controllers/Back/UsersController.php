<?php

namespace App\Http\Controllers\Back;

use App\Models\Cv;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with(['userdetails', 'businessgallery', 'skill', 'language', 'experience', 'certificate'])->get();

        $completionPercentages = [];

        foreach ($users as $user) {
            $totalSections = 6;
            $completedSections = 0;

            if ($user->userdetails) $completedSections++;
            if ($user->businessgallery && $user->businessgallery->count() > 0) $completedSections++;
            if ($user->skill && $user->skill->count() > 0) $completedSections++;
            if ($user->language && $user->language->count() > 0) $completedSections++;
            if ($user->experience && $user->experience->count() > 0) $completedSections++;
            if ($user->certificate && $user->certificate->count() > 0) $completedSections++;

            $completionPercentage = round(($completedSections / $totalSections) * 100);
            
            $completionPercentages[$user->id] = $completionPercentage;
        }

        return view('back.users.index', compact('users', 'completionPercentages'));
    }

    public function show($id){
        $user = User::findOrfail($id);
        $city = City::all();
        $selectedCityId = $user->city_id;
        return view('back.users.show',compact('user','city','selectedCityId'));
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20'. $user->id,
                'password' => 'nullable|string|min:6|confirmed',
                'gender' => 'required|string',
                'nationality' => 'required|string',
                'birthday' => 'nullable|date',
                'city_id' => 'required|integer|exists:cities,id',
                'address' => 'nullable|string',
            ]);

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->nationality = $request->input('nationality');
            $user->birthday = $request->input('birthday');
            $user->city_id = $request->input('city_id');
            $user->address = $request->input('address');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();
            toastr()->warning(trans('route.Update_messages'));
            
            return redirect()->route('users');

        } catch (\Exception $a) {
            return redirect()->back()->withErrors(['error' => $a->getMessage()]);
        }
    }

    public function updateActiveStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->active = $request->input('active');
        $user->save();

        $user->tokens()->delete();
        return response()->json(['success' => 'User status updated successfully']);
    }


    public function downloadCV($cvId)
    {
        $cv = Cv::find($cvId);
        if(!$cv)
         return redirect()->back()->with('error', 'CV not found.');

        $filePath = public_path($cv->cv);
        
        if (File::exists($filePath)) 
           return response()->download($filePath);

    }

}
