<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Profession;
use App\Models\Report;
use App\Models\file;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('doctor_comment', null)->with('user')->latest()->get();
        return view('pages.reports.index', compact('reports'));
    }

    public function answered_reports()
    {
        $reports = Report::where('doctor_comment', '!=', null)->with(['user', 'doctor'])->latest()->get();

        return view('pages.reports.answered', compact('reports'));
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
        if (!empty($request->transaction)) {
            $transaction_name = time() . '.' . $request->transaction->extension();

            $request->transaction->move(public_path('images/transaction'), $transaction_name);
        }

        $report = Report::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'profession' => $request->profession,
            'family_related' => $request->family_related,
            'sleep_on_hospital' => $request->sleep_on_hospital,
            'surgery' => $request->surgery,
            'notes' => $request->notes,
            'transaction' => $transaction_name,
            'user_id' => auth()->user()->id
        ]);

        if (!empty($request->file))
            foreach ($request->file as $file) {
                $file_name = $file->getClientOriginalName();
                $file_extention = $file->extension();
                $file->move(public_path('files'), $file_name . '.' . $file_extention);

                file::create([
                    'name' => $file_name,
                    'path' => $file_name . '.' . $file_extention,
                    'report_id' => $report->id
                ]);
            }


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show_dashboard(Report $report)
    {
        $report = $report->with(['files', 'user'])->first();
        $doctors = Doctor::where('profession', $report->profession)->get();
        return view('pages.reports.show', compact(['report', 'doctors']));
    }

    public function show_answered_dashboard(Report $report)
    {
        $report = $report->with(['files', 'user', 'doctor'])->first();
        return view('pages.reports.show_answered', compact('report'));
    }

    public function assign_doctor(Request $request, Report $report)
    {
        $report->update([
            'doctor_id' => $request->doctor_id
        ]);

        $notification = Notification::create([
            'receiver_id' => $request->doctor_id,
            'body' => 'تم الحاقك لعمل تقرير جديد لاحد المرضي ',
        ]);


        return redirect()->route('show reports');
    }

    public function get_all_reports()
    {
        if (auth()->user() != null) {
            $reports = Report::where('user_id', auth()->user()->id)->select(['title', 'id', 'desc'])->latest()->get();
            return response()->json([
                'status' => 'success',
                'reports' => $reports,
            ]);
        } else {
            $reports = Report::where('doctor_id', auth()->guard('doctor')->user()->id)->select(['title', 'id', 'desc'])->latest()->get();
            return response()->json([
                'status' => 'success',
                'reports' => $reports,
            ]);
        }

        return response()->json([
            'status' => 'error'
        ]);
    }

    public function get_report(Report $report)
    {

        if (auth()->user() != null) {
            if (auth()->user()->id == $report->user_id) {

                $report = $report->with(['files', 'user'])->first();

                return response()->json([
                    'status' => 'success',
                    'report' => $report,
                ]);
            }
        } else {
            if (auth()->guard('doctor')->user()->id == $report->doctor_id) {

                $report = $report->with(['files', 'user'])->first();

                return response()->json([
                    'status' => 'success',
                    'report' => $report,
                ]);
            }
        }
    }

    public function answer(Request $request, Report $report)
    {
        if (auth()->guard('doctor')->user()->id == $report->doctor_id) {
            $report->update([
                'doctor_comment' => $request->answer
            ]);

            $notification = Notification::create([
                'receiver_id' => $report->user_id,
                'body' => 'تم الرد علي طلب التقرير الخاص بك ',
            ]);

            return response()->json([
                'status' => 'success',
            ]);
        } else {
            response()->json([
                'status' => 'error'
            ]);
        }
    }
}
