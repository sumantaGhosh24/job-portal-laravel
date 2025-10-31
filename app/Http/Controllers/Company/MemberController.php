<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|string',
            'department' => 'required|string',
        ]);

        $existing = Member::where('user_id', $request->user_id) ->where('status', 'active') ->first();
        if ($existing) {
            return back()->with('message', 'User already belongs to another company.');
        }

        Member::create([
            'company_id' => $id,
            'user_id' => $request->user_id,
            'role' => 'employee',
            'position' => $request->position,
            'department' => $request->department,
            'status' => 'active',
            'joining_date' => now(),
        ]);

        return back()->with('message', 'Employee added successfully.');
    }

    public function remove(string $id)
    {
        $member = Member::find($id);

        $member->update([
            'status' => 'ex-employee',
            'role' => 'ex-employee',
            'leaving_date' => now(),
        ]);

        return back()->with('message', 'Employee marked as ex-employee.');
    }
}
