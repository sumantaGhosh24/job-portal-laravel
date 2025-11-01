<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function create() {
        $id = Auth::id();
        
        $user = User::find($id);

        return view('companies.create', [
            'user' => $user
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:150'],
            'sector' => ['required', 'string', 'min:5', 'max:50'],
            'size' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:20'],
            'location' => ['required', 'string', 'min:5', 'max:150'],
        ]);

        DB::transaction(function () use ($request) {
            $company = Company::create([
                'name' => $request->name,
                'sector' => $request->sector,
                'size' => $request->size,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'location' => $request->location,
                'owner_id' => $request->user()->id,
            ]);

            Member::create([
                'company_id' => $company->id,
                'user_id' => $request->user()->id,
                'role' => 'admin',
                'status' => 'active',
                'joining_date' => now(),
            ]);
        });

        return redirect()->route('companies.create')->with('message', 'Company created successfully!');
    }

    public function show(string $id) {
        $company = Company::find($id);

        $userId = Auth::id();
        $member = Member::where('user_id', $userId)->where('company_id', $id)->first();

        return view('companies.details', [
            'company' => $company,
            'member' => $member,
        ]);
    }

    public function information(Request $request, string $id) {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:150'],
            'sector' => ['required', 'string', 'min:5', 'max:50'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:20'],
            'size' => ['required', 'string', 'max:50'],
            'location' => ['required', 'string', 'min:5', 'max:150'],
        ]);

        $company = Company::find($id);

        $company->update(['name' => $request->name, 'sector' => $request->sector, 'phone_number' => $request->phone_number, 'email' => $request->email, 'size' => $request->size, 'location' => $request->location]);

        return redirect()->route('companies.show', ['id' => $company->id])->with('message', 'Company information updated successfully!');
    }

    public function description(Request $request, string $id) {
        $request->validate([
            'description' => ['required', 'string', 'min:5', 'max:500'],
            'slogan' => ['required', 'string', 'min:5', 'max:250']
        ]);

        $company = Company::find($id);

        $company->update(['description' => $request->description, 'slogan' => $request->slogan]);

        return redirect()->route('companies.show', ['id' => $company->id])->with('message', 'Company description updated successfully!');
    }

    public function logo(Request $request, string $id) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $company = Company::find($id);

        if (isset($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $company->update(['logo' => $newName]);

        return redirect()->route('companies.show', ['id' => $company->id])->with('message', 'Company logo updated successfully!');
    }

    public function banner(Request $request, string $id) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $company = Company::find($id);

        if (isset($company->banner)) {
            Storage::disk('public')->delete($company->banner);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $company->update(['banner' => $newName]);

        return redirect()->route('companies.show', ['id' => $company->id])->with('message', 'Company banner updated successfully!');
    }

    public function social(Request $request, string $id) {
        $request->validate([
            'linkedin_url' => 'url:http,https',
            'twitter_url' => 'url:http,https',
            'facebook_url' => 'url:http,https',
            'youtube_url' => 'url:http,https',
            'instagram_url' => 'url:http,https',
            'website_url' => 'url:http,https',
        ]);

        $company = Company::find($id);

        $company->update(['linkedin_url' => $request->linkedin_url, 'twitter_url' => $request->twitter_url, 'facebook_url' => $request->facebook_url, 'youtube_url' => $request->youtube_url, 'instagram_url' => $request->instagram_url, 'website_url' => $request->website_url]);

        return redirect()->route('companies.show', ['id' => $company->id])->with('message', 'Company social links updated successfully!');
    }
}
