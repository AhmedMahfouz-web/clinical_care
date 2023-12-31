<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Meeting;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if (!empty($request->image)) {
            $image_name = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/transaction'), $image_name);
        }
        // Create a meeting
        $meeting = Meeting::create([
            'user_id' => auth()->user()->id,
            'doctor_id' => $request->doctor_id,
            'image' => $image_name,
            'status' => 'pending',
            'price' => '5000',
            'start_at' => $request->start_at,
        ]);

        // Notify the admin about the new meeting
        $admins = Admin::where('role', 'admin')->get();

        if ($admins->count() > 0) {
            foreach ($admins as $admin) {
                $admin->notify(new MeetingScheduled($meeting));
            }
        }

        broadcast(new MeetingScheduled($meeting))->toOthers();

        return response()->json(['message' => 'Meeting created successfully', 'meeting' => $meeting]);
    }

    public function get_meetings()
    {
        $meetings = Meeting::orderByRaw("FIELD(status, 'pending', 'canceled', 'approved') desc")->latest()->with(['doctor', 'user'])->get();

        return view('pages.meetings.index', compact('meetings'));
    }

    public function update_status(Request $request, Meeting $meeting)
    {
        $meeting->update([
            'status' => $request->status,
            'start_at' => $meeting->start_at
        ]);

        return redirect()->route('show meetings');
    }

    public function start_meeting()
    {
        $meetings = Zoom::createMeeting([
            "agenda" => 'your agenda',
            "topic" => 'your topic',
            "type" => 1, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "duration" => 60, // in minutes
            "timezone" => 'Asia/Dhaka', // set your timezone
            "password" => '',
            "template_id" => 'set your template id', // set your template id  Ex: "Dv4YdINdTk+Z5RToadh5ug==" from https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetingtemplates
            "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
            "settings" => [
                'join_before_host' => false, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => false, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => 0, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],

        ]);

        return response()->json([$meetings]);
    }
}
