<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('doctor_id', null)->get();

        return view('pages.reports.index', compact('reports'));
    }

    public function create()
    {
        $professions = Profession::all();

        return response()->json([
            'status' => 'success',
            'professions' => $professions
        ]);
    }

    public function store(Request $request)
    {

        

        return response()->json([
            'status' => 'success',
            // 'professions' => $professions
        ]);
    }
}
