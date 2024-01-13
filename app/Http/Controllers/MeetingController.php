<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Meeting;
use App\Models\MeetingFiles;
use App\Models\Notification;
use App\Notifications\MeetingScheduled;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;

class MeetingController extends Controller
{
    public function create_meeting(Request $request)
    {
        // Validate request data as needed
        $request->validate([
            'transaction' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if (!empty($request->transaction)) {
            $image_name = time() . '.' . $request->transaction->extension();

            $request->transaction->move(public_path('images/transaction'), $image_name);
        }

        // Create a meeting
        $meeting = Meeting::create([
            'user_id' => auth()->user()->id,
            'transaction' => $image_name,
            'price' => $request->price,
            'profession' => $request->profession,
            'notes' => $request->notes
        ]);

        if (!empty($request->file))
            foreach ($request->file as $file) {
                $file_name = $file->getClientOriginalName();
                $file_extention = $file->extension();
                $file->move(public_path('files'), $file_name . '.' . $file_extention);

                MeetingFiles::create([
                    'name' => $file_name,
                    'path' => $file_name . '.' . $file_extention,
                    'meeting_id' => $meeting->id
                ]);
            }


        return response()->json(['message' => 'Meeting created successfully', 'meeting' => $meeting]);
    }

    public function get_meetings()
    {
        $meetings = Meeting::orderByRaw("FIELD(status, 'pending', 'canceled', 'approved') desc")->latest()->with(['doctor', 'user'])->get();

        return view('pages.meetings.index', compact('meetings'));
    }

    public function edit(Meeting $meeting)
    {
        $meeting->load(['files', 'user']);
        $doctors = Doctor::where('profession', $meeting->profession)->get();
        return view('pages.meetings.show_answered', compact(['meeting', 'doctors']));
    }

    public function assign_doctor(Request $request, Meeting $meeting)
    {
        $request->validate([
            'start_at' => 'required',
            'doctor_id' => 'required'
        ]);

        $meeting->update([
            'start_at' => $request->start_at,
            'doctor_id' => $request->doctor_id,
            'meeting_id' => $meeting->user_id . $request->doctor_id,
            'status' => 'accepted'
        ]);

        Notification::create([
            'receiver_id' => $request->doctor_id,
            'model' => 'meeting',
            'model_id' => $meeting->id,
            'body' => 'تم الحاقك لمقابلة جديدة في الوقت ' . $meeting->start_at,
        ]);

        Notification::create([
            'receiver_id' => $meeting->user_id,
            'model' => 'meeting',
            'model_id' => $meeting->id,
            'body' => 'تم الحاق دكتور لعمل مقابلة جديدة في الوقت ' . $meeting->start_at,
        ]);

        return redirect()->route('show meetings');
    }
}
