<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller {
    public function add(Request $request) {
        $request->validate([
            'degree' => ['required', 'string', 'min:3', 'max:50'],
            'field_of_study' => ['required', 'string', 'min:3', 'max:50'],
            'institution_name' => ['required', 'string', 'min:3', 'max:150'],
            'location' => ['required', 'string', 'min:3', 'max:100'],
            'graduation_date' => ['required', 'date'],
        ]);

        Education::create(['degree' => $request->degree, 'field_of_study' => $request->field_of_study, 'institution_name' => $request->institution_name, 'location' => $request->location, 'graduation_date' => $request->graduation_date, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Education added successfully!');
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'degree' => ['required', 'string', 'min:3', 'max:50'],
            'field_of_study' => ['required', 'string', 'min:3', 'max:50'],
            'institution_name' => ['required', 'string', 'min:3', 'max:150'],
            'location' => ['required', 'string', 'min:3', 'max:100'],
            'graduation_date' => ['required', 'date'],
        ]);

        $education = Education::find($id);

        $education->update(['degree' => $request->degree, 'field_of_study' => $request->field_of_study, 'institution_name' => $request->institution_name, 'location' => $request->location, 'graduation_date' => $request->graduation_date]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Education updated successfully!');
    }

    public function destroy(Request $request, string $id) {
        $education = Education::find($id);

        $education->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Education deleted successfully!');
    }
}