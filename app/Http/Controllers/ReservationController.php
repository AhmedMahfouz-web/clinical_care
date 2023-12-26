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
        $test = Test::all();

        return response()->json([
            'status' => 'success',
            'professions' => $hospitals
        ]);
    }

    public function store(Request $request)
    {
        if (!empty($request->transaction)) {
            $transaction_name = time() . '.' . $request->transaction->extension();

            $request->transaction->move(public_path('images/transaction'), $transaction_name);
        }

        $reservation = reservation::create([
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


        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show_dashboard(reservation $reservation)
    {
        $reservation = $reservation->with(['files', 'user'])->first();
        return view('pages.reservations.show', compact(['reservation']));
    }

    public function show_answered_dashboard(reservation $reservation)
    {
        $reservation = $reservation->with(['files', 'user', 'doctor'])->first();
        return view('pages.reservations.show_answered', compact('reservation'));
    }

    public function assign_doctor(Request $request, reservation $reservation)
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
