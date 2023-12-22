<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Notification;
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

        $report = Report::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'profession' => $request->profession,
            'family_related' => $request->family_related,
            'sleep_on_hospital' => $request->sleep_on_hospital,
            'surgery' => $request->surgery,
            'notes' => $request->notes,
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show_dashboard(Report $report)
    {
        return view('pages.reports.show', compact('report'));
    }

    public function assign_doctor(Request $request, Report $report)
    {
        $report->update([
            'doctor_id', $request->doctor_id
        ]);

        $notification = Notification::create([
            'receiver_id' => $request->doctor_id,
            'body' => 'تم الحاقك لعمل تقرير جديد لاحد المرضي ',
        ]);


        return redirect()->route('show reports');
    }
}
