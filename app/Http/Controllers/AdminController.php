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
        if (auth()->guard('admin')->user()->role == 'صاحب منشأة') {
            $admins = Admin::all();

            return view('pages.admins.index', compact('admins'));
        }

        return back();
    }

    public function create()
    {
        if (auth()->guard('admin')->user()->role == 'صاحب منشأة') {
            return view('pages.admins.create');
        }

        return back();
    }

    public function store(Request $request)
    {
        if (auth()->guard('admin')->user()->role == 'صاحب منشأة') {
            Admin::create([
                'id' => check_uuid('App\Models\Admin', Uuid::generate()),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $$role,
            ]);

            return redirect()->route('show admins')->with('success', 'تم اضافة ' . $request->role . ' بنجاح');
        }

        return back();
    }

    public function edit(Admin $admin)
    {
        if (auth()->guard('admin')->user()->role == 'صاحب منشأة') {
            return view('pages.admins.edit', compact('admin'));
        }

        return back();
    }

    public function update(Request $request, Admin $admin)
    {
        if (auth()->guard('admin')->user()->role == 'صاحب منشأة') {
            $admin->update([
                'name' => $request->name,
                'password' => $request->password,
                'email' => $request->email,
                'role' => $request->role
            ]);

            return redirect()->route('show admins')->with('success', 'تم تعديل ' . $request->role . ' بنجاح');
        }

        return back();
    }

    public function destroy(Request $request, Admin $admin)
    {
        if (auth()->guard('admin')->user()->role == 'صاحب منشأة') {
            $admin->delete();

            return redirect()->route('show admins')->with('success', 'تم حذف ' . $request->role . ' بنجاح');
        }

        return back();
    }
}
