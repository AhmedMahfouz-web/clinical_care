<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Test;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $users_count = User::count();
        $doctors_count = Doctor::count();
        $hospitals_count = Hospital::count();
        $tests_count = Test::count();

        return view('pages.home', compact(['users_count', 'doctors_count', 'hospitals_count', 'tests_count']));
    }
}
