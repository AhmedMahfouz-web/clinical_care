<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        return view('pages.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('pages.admins.create');
    }

    public function store(Request $request)
    {
        Admin::create([
            'id' => check_uuid('App\Models\Admin', Uuid::generate()),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $$role,
        ]);

        return redirect()->route('show admins')->with('success', 'تم اضافة ' . $request->role . ' بنجاح');
    }

    public function edit(Admin $admin)
    {
        return view('pages.admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $admin->update([
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('show admins')->with('success', 'تم تعديل ' . $request->role . ' بنجاح');
    }

    public function destroy(Request $request, Admin $admin)
    {
        $admin->delete();

        return redirect()->route('show admins')->with('success', 'تم حذف ' . $request->role . ' بنجاح');
    }
}
