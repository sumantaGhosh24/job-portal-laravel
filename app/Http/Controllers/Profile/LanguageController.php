<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function add(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'proficiency' => ['required', 'string', 'min:3', 'max:20'],
        ]);

        Language::create(['name' => $request->name, 'proficiency' => $request->proficiency, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Language added successfully!');
    }

    public function update(Request $request, string $id): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'proficiency' => ['required', 'string', 'min:3', 'max:20'],
        ]);

        $language = Language::find($id);

        $language->update(['name' => $request->name, 'proficiency' => $request->proficiency]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Language updated successfully!');
    }

    public function destroy(Request $request, string $id): RedirectResponse {
        $language = Language::find($id);

        $language->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Language deleted successfully!');
    }
}