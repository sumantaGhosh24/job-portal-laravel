<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employer;
use App\Models\User;

class ManageUserController extends Controller
{
    public function users()
    {
        $users = User::all();

        return view('admin.users', ['users' => $users]);
    }

    public function employers()
    {
        $employers = Employer::all();

        return view('admin.employers', ['employers' => $employers]);
    }

    public function admins()
    {
        $admins = Admin::all();

        return view('admin.admins', ['admins' => $admins]);
    }
}