<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
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

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        $user = $request->user();
        
        $user->languages()->delete();
        $user->certificates()->delete();
        $user->projects()->delete();
        $user->skills()->delete();
        $user->educations()->delete();
        $user->experiences()->delete();

        if (isset($request->user()->profile_image)) {
            Storage::disk('public')->delete($request->user()->profile_image);
        }

        if (isset($request->user()->background_image)) {
            Storage::disk('public')->delete($request->user()->background_image);
        }

        if (isset($request->user()->resume)) {
            Storage::disk('public')->delete($request->user()->resume);
        }

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