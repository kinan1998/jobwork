<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompletionController extends Controller
{

    use GeneralTrait;
    
    public function getCompletionPercentage()
    {
        $userToken = auth()->user()->id;

        $user = User::with(['userdetails', 'businessgallery', 'skill', 'language', 'experience', 'certificate'])
        ->find($userToken);

        if (!$userToken) {
            return $this->returnError('User  not found');
        }

        $totalSections = 6;
        $completedSections = 0;

        if ($user->userdetails) $completedSections++;
        if ($user->businessgallery->count() > 0) $completedSections++;
        if ($user->skill->count() > 0) $completedSections++;
        if ($user->language->count() > 0) $completedSections++;
        if ($user->experience->count() > 0) $completedSections++;
        if ($user->certificate->count() > 0) $completedSections++;

        $completionPercentage = round(($completedSections / $totalSections) * 100);

        return $this -> returnData('completion_percentage',$completionPercentage);

       
    }
}
