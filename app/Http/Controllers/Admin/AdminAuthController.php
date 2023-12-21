<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        if (Auth::guard('admin')->user()) {
            return redirect()->route('dashboard')->with("انت بالفعل داخل لوحة التحكم");
        }
        return view('pages.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])) {
            return redirect()->route('dashboard')->with('success', 'You are Logged in sucessfully.');
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
}
