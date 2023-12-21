<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Meeting;
use App\Notifications\MeetingScheduled;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function createMeeting(Request $request, $userId, $doctorId)
    {
        // Validate request data as needed
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image_name = time() . '.' . $request->image->extension();

        $request->image->storeAs('images', $image_name, 'public');

        // Create a meeting
        $meeting = Meeting::create([
            'user_id' => auth()->user()->id,
            'doctor_id' => $doctorId,
            'image' => $image_name,
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

    public function getInitialMeetings(Request $request)
    {
        $meetings = Meeting::all();

        return response()->json(['meetings' => $meetings]);
    }
}
