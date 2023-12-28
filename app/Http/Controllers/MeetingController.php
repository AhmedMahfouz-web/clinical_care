<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Meeting;
use App\Notifications\MeetingScheduled;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;


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
        $jitsi_server_url = config("app.jitsi_url");
        $jitsi_jwt_token_secret = config("app.jwt_secret");

        $payload = array(
            "aud" => "jitsi",
            "iss" => "chat",
            "exp" => time() + 7200,
            "nbf" => time() - 0,
            "sub" => "vpaas-magic-cookie-7d479d683caa4989be5d801ba84dd349",
            "context" => [
                "features" => [
                    "livestreaming" => true,
                    "outbound-call" => true,
                    "sip-outbound-call" => false,
                    "transcription" => true,
                    "recording" => true
                ],
                "user" => [
                    "hidden-from-recorder" => false,
                    "moderator" => true,
                    "name" => auth()->user()->fist_name,
                    "avatar" => "",
                ]
            ],
            "room" => "hello"
        );

        $token = JWT::encode($payload, $jitsi_jwt_token_secret, "RS256");

        return response()->json([
            'token' => $token
        ]);
    }
}
