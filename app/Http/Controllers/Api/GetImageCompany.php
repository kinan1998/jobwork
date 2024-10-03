<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetImageCompany extends Controller
{
    use GeneralTrait;

    public function getTopCompanyImages()
    {
        $companies = Company::withCount('JobOpportunity')
            ->limit(4)
            ->get(['image']);
    
        $companies->each(function($company) {
            $company->image = asset($company->image);
        });
    
        $images = $companies->pluck('image');
    
        return $this->returnData('images', $images);
    }
}
