<?php

namespace App\Http\Controllers\Api;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CVJobWorkController extends Controller
{
    public function download_web(Request $request,$id)
    {
        
        $user = User::findOrFail($id);
        $pdf = PDF::loadView('cv.cv', compact('user'));
        return $pdf->download('cv_' . $user->first_name . '_' . $user->last_name . '_' . '.pdf');
    }


    public function download_api($id)
    {
        $user = User::findOrFail($id);

        $user->load(['scopework', 'jobtitle', 'businessgallery', 'userdetails', 'city', 'skill', 'language', 'experience', 'certificate']);

        $pdf = PDF::loadView('cv.cv', compact('user'));

        $fileName = 'cv_'.$user->first_name.'_'.$user->last_name.'.pdf';

        $filePath = public_path('downloads/' . $fileName);

        $pdf->save($filePath);

        return response()->json([
            'url' => url('downloads/' . $fileName)
        ]);
    }


}
