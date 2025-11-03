<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyFollowController extends Controller
{
    public function follow(Company $company)
    {
        auth()->user()->followedCompanies()->attach($company->id);
        
        return back()->with('message', 'You are now following ' . $company->name);
    }

    public function unfollow(Company $company)
    {
        auth()->user()->followedCompanies()->detach($company->id);
        
        return back()->with('message', 'You have unfollowed ' . $company->name);
    }
}