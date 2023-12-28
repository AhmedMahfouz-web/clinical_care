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

    public function start_meeting(Request $request, $type)
    {
        $jitsi_server_url = config("app.jitsi_url");
        $jitsi_jwt_token_secret = '-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----';
        $private_key = 'vpaas-magic-cookie-7d479d683caa4989be5d801ba84dd349/71fdaa';

        if ($type = 'doctor') {
            $user = auth()->guard('doctor')->user()->first_name . ' ' . auth()->guard('doctor')->user()->last_name;
        } else {
            $user = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        }

        $payload = array(
            "aud" => "jitsi",
            "iss" => "chat",
            "exp" => time() + 7200,
            "nbf" => time() - 0,
            "sub" => "vpaas-magic-cookie-7d479d683caa4989be5d801ba84dd349/71fdaa",
            'room' => $request->meeting_id,
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
                    "moderator" => false,
                    "name" => $user,
                    "avatar" => "",
                ]
            ]
        );

        $token = JWT::encode($payload, $jitsi_jwt_token_secret, "RS256", $private_key);

        return response()->json([
            'token' => $token
        ]);
    }
}
