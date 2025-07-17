<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function edit(Request $request): View
    {
        return view('user.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:20'],
            'lastName' => ['required', 'string', 'min:3', 'max:20'],
            'username' => ['required', 'alpha_num:ascii', 'min:3', 'max:20'],
            'mobileNumber' => ['required', 'string', 'min:10', 'max:10'],
            'dob' => ['required', Rule::date()->format('Y-m-d')],
            'gender' => ['required', 'string', 'max:10']
        ]);

        $request->user()->firstName = $request->firstName;
        $request->user()->lastName = $request->lastName;
        $request->user()->username = $request->username;
        $request->user()->mobileNumber = $request->mobileNumber;
        $request->user()->dob = $request->dob;
        $request->user()->gender = $request->gender;

        $request->user()->save();

        return redirect()->route('user.profile.edit')->with('message', 'User information updated successfully!');
    }

    public function address(Request $request): RedirectResponse
    {
        $request->validate([
            'city' => ['required', 'string', 'min:3', 'max:20'],
            'state' => ['required', 'string', 'min:3', 'max:20'],
            'country' => ['required', 'string', 'min:3', 'max:20'],
            'zip' => ['required', 'string', 'min:3', 'max:20'],
            'addressline' => ['required', 'string', 'min:3', 'max:50']
        ]);

        $request->user()->city = $request->city;
        $request->user()->state = $request->state;
        $request->user()->country = $request->country;
        $request->user()->zip = $request->zip;
        $request->user()->addressline = $request->addressline;

        $request->user()->save();

        return redirect()->route('user.profile.edit')->with('message', 'User address updated successfully!');
    }

    public function image(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        $request->user()->image = $newName;

        $request->user()->save();

        return redirect()->route('user.profile.edit')->with('message', 'User image updated successfully!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        if ($request->user()->image) {
            Storage::disk('public')->delete($request->user()->image);
        }

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}