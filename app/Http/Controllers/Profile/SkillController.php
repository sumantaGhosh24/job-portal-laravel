<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller {
    public function add(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'proficiency' => ['required', 'string', 'min:3', 'max:50'],
        ]);

        Skill::create(['name' => $request->name, 'proficiency' => $request->proficiency, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Skill added successfully!');
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'proficiency' => ['required', 'string', 'min:3', 'max:50'],
        ]);

        $skill = Skill::find($id);

        $skill->update(['name' => $request->name, 'proficiency' => $request->proficiency]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Skill updated successfully!');
    }

    public function destroy(Request $request, string $id) {
        $skill = Skill::find($id);

        $skill->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Skill deleted successfully!');
    }
}