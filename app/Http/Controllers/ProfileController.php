<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Language;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function show(string $id) {
        $user = User::find($id);

        $userId = Auth::id();

        return view('profile.details', [
            'user' => $user,
            'user_id' => $userId,
        ]);
    }

    public function personal(Request $request): RedirectResponse {
        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:20'],
            'last_name' => ['required', 'string', 'min:3', 'max:20'],
            'mobile_number' => ['required', 'string', 'min:10', 'max:10'],
            'city' => ['required', 'string', 'min:3', 'max:20'],
            'state' => ['required', 'string', 'min:3', 'max:20'],
            'country' => ['required', 'string', 'min:3', 'max:20'],
            'zip' => ['required', 'string', 'min:3', 'max:20'],
            'addressline' => ['required', 'string', 'min:3', 'max:50'],
            'desired_job_title' => ['required', 'string', 'min:3', 'max:50'],
            'desired_job_type' => ['required', 'string', 'min:3', 'max:50'],
        ]);
        
        $request->user()->first_name = $request->first_name;
        $request->user()->last_name = $request->last_name;
        $request->user()->mobile_number = $request->mobile_number;
        $request->user()->city = $request->city;
        $request->user()->state = $request->state;
        $request->user()->country = $request->country;
        $request->user()->zip = $request->zip;
        $request->user()->addressline = $request->addressline;
        $request->user()->desired_job_title = $request->desired_job_title;
        $request->user()->desired_job_type = $request->desired_job_type;

        $request->user()->save();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User profile personal information updated successfully!');
    }

    public function profile_image(Request $request): RedirectResponse {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if (isset($request->user()->profile_image)) {
            Storage::disk('public')->delete($request->user()->profile_image);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $request->user()->profile_image = $newName;

        $request->user()->save();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User profile image updated successfully!');
    }

    public function background_image(Request $request): RedirectResponse {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if (isset($request->user()->background_image)) {
            Storage::disk('public')->delete($request->user()->background_image);
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $request->user()->background_image = $newName;

        $request->user()->save();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User background image updated successfully!');
    }

    public function password(Request $request): RedirectResponse {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User password updated successfully!');
    }

    public function professional_summary(Request $request): RedirectResponse {
        $request->validate([
            'headline' => ['required', 'string', 'min:3', 'max:150'],
            'professional_summary' => ['required', 'string', 'min:3', 'max:250'],
        ]);
        
        $request->user()->headline = $request->headline;
        $request->user()->professional_summary = $request->professional_summary;

        $request->user()->save();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User professional summary updated successfully!');
    }

    public function resume(Request $request): RedirectResponse {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:3072'
        ]);

        if (isset($request->user()->resume)) {
            Storage::disk('public')->delete($request->user()->resume);
        }

        if ($request->file('resume')) {
            $image = $request->file('resume');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $request->user()->resume = $newName;

        $request->user()->save();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User resume updated successfully!');
    }

    public function social(Request $request): RedirectResponse {
        $request->validate([
            'linkedin_url' => 'url:http,https',
            'github_url' => 'url:http,https',
            'website_url' => 'url:http,https',
        ]);
        
        $request->user()->linkedin_url = $request->linkedin_url;
        $request->user()->github_url = $request->github_url;
        $request->user()->website_url = $request->website_url;

        $request->user()->save();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'User social links updated successfully!');
    }

    public function add_language(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'proficiency' => ['required', 'string', 'min:3', 'max:20'],
        ]);

        Language::create(['name' => $request->name, 'proficiency' => $request->proficiency, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Language added successfully!');
    }

    public function update_language(Request $request, string $id): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'proficiency' => ['required', 'string', 'min:3', 'max:20'],
        ]);

        $language = Language::find($id);

        $language->update(['name' => $request->name, 'proficiency' => $request->proficiency]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Language updated successfully!');
    }

    public function remove_language(Request $request, string $id): RedirectResponse {
        $language = Language::find($id);

        $language->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Language deleted successfully!');
    }

    public function add_certificate(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'issuing_organization' => ['required', 'string', 'min:3', 'max:100'],
            'issue_date' => ['required', 'date'],
        ]);

        Certificate::create(['name' => $request->name, 'issuing_organization' => $request->issuing_organization, 'issue_date' => $request->issue_date, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Certificate added successfully!');
    }

    public function update_certificate(Request $request, string $id): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'issuing_organization' => ['required', 'string', 'min:3', 'max:100'],
            'issue_date' => ['required', 'date'],
        ]);

        $certificate = Certificate::find($id);

        $certificate->update(['name' => $request->name, 'issuing_organization' => $request->issuing_organization, 'issue_date' => $request->issue_date]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Certificate updated successfully!');
    }

    public function remove_certificate(Request $request, string $id): RedirectResponse {
        $certificate = Certificate::find($id);

        $certificate->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Certificate deleted successfully!');
    }

    public function add_project(Request $request): RedirectResponse {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:500'],
            'github_url' => ['required', 'url'],
        ]);

        Project::create(['title' => $request->title, 'description' => $request->description, 'github_url' => $request->github_url, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Project added successfully!');
    }

    public function update_project(Request $request, string $id): RedirectResponse {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:500'],
            'github_url' => ['required', 'url'],
        ]);

        $project = Project::find($id);

        $project->update(['title' => $request->title, 'description' => $request->description, 'github_url' => $request->github_url]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Project updated successfully!');
    }

    public function remove_project(Request $request, string $id): RedirectResponse {
        $project = Project::find($id);

        $project->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Project deleted successfully!');
    }

    public function add_skill(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'proficiency' => ['required', 'string', 'min:3', 'max:50'],
        ]);

        Skill::create(['name' => $request->name, 'proficiency' => $request->proficiency, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Skill added successfully!');
    }

    public function update_skill(Request $request, string $id): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'proficiency' => ['required', 'string', 'min:3', 'max:50'],
        ]);

        $skill = Skill::find($id);

        $skill->update(['name' => $request->name, 'proficiency' => $request->proficiency]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Skill updated successfully!');
    }

    public function remove_skill(Request $request, string $id): RedirectResponse {
        $skill = Skill::find($id);

        $skill->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Skill deleted successfully!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        if (isset($request->user()->profile_image)) {
            Storage::disk('public')->delete($request->user()->profile_image);
        }

        if (isset($request->user()->background_image)) {
            Storage::disk('public')->delete($request->user()->background_image);
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $user->languages()->delete();
        $user->certificates()->delete();
        $user->projects()->delete();
        $user->skills()->delete();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}