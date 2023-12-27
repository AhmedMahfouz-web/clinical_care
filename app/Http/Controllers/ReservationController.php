<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Notification;
use App\Models\Profession;
use App\Models\Reservation;
use App\Models\Test;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('status', 'pending')->with('user')->latest()->get();
        return view('pages.reservations.index', compact('reservations'));
    }

    public function reserved()
    {
        $reservation = Reservation::where('doctor_comment', '!=', null)->with(['user', 'doctor'])->latest()->get();

        return view('pages.reservations.answered', compact('reservations'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        $tests = Test::all();

        return response()->json([
            'status' => 'success',
            'hospitals' => $hospitals,
            'tests' => $tests,
        ]);
    }

    public function store(Request $request)
    {
        if (!empty($request->transaction)) {
            $transaction_name = time() . '.' . $request->transaction->extension();

            $request->transaction->move(public_path('images/transaction'), $transaction_name);
        }

        $reservation = Reservation::create([
            'user_id' => auth()->user()->id,
            'hospital_id' => $request->hospital_id,
            'test_id' => $request->test_id,
            'transaction' => $transaction_name,
        ]);


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show_answered_dashboard(Reservation $reservation)
    {
        $reservation = $reservation->with('user', 'doctor')->first();
        return view('pages.reservations.show_answered', compact('reservation'));
    }

    public function reserve(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'doctor_id' => $request->doctor_id
        ]);

        $notification = Notification::create([
            'receiver_id' => $request->doctor_id,
            'body' => 'تم الحاقك لعمل تقرير جديد لاحد المرضي ',
        ]);


        return redirect()->route('show reservations');
    }

    public function get_reservation(reservation $reservation)
    {
        if (auth()->guard('doctor')->user()->id == $reservation->doctor_id || auth()->user()->id == $reservation->user_id) {
            return response()->json([
                'status' => 'success',
                'reservation' => $reservation->with(['files', 'user']),
            ]);
        }
    }

    public function answer(Request $request, reservation $reservation)
    {
        if (auth()->guard('doctor')->user()->id == $reservation->doctor_id) {
            $reservation->update([
                'doctor_comment', $request->answer
            ]);

            $notification = Notification::create([
                'receiver_id' => $reservation->user_id,
                'body' => 'تم الرد علي طلب التقرير الخاص بك ',
            ]);
        }


        return response()->json([
            'status' => 'success',
        ]);
    }
}
