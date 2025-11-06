<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller {
    public function add(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'issuing_organization' => ['required', 'string', 'min:3', 'max:100'],
            'issue_date' => ['required', 'date'],
        ]);

        Certificate::create(['name' => $request->name, 'issuing_organization' => $request->issuing_organization, 'issue_date' => $request->issue_date, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Certificate added successfully!');
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'issuing_organization' => ['required', 'string', 'min:3', 'max:100'],
            'issue_date' => ['required', 'date'],
        ]);

        $certificate = Certificate::find($id);

        $certificate->update(['name' => $request->name, 'issuing_organization' => $request->issuing_organization, 'issue_date' => $request->issue_date]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Certificate updated successfully!');
    }

    public function destroy(Request $request, string $id) {
        $certificate = Certificate::find($id);

        $certificate->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Certificate deleted successfully!');
    }
}