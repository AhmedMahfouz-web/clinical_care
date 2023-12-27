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
        $reservations = Reservation::with(['user', 'hospital', 'test'])->latest()->all();
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

    public function show_reserved_dashboard(Reservation $reservation)
    {
        $reservation->load('user', 'hospital', 'test');
        return view('pages.reservations.show_answered', compact('reservation'));
    }

    public function reserve(Request $request, Reservation $reservation)
    {
        if ($reservation->status != $request->status) {
            $reservation->update([
                'status' => $request->status
            ]);

            $notification = Notification::create([
                'receiver_id' => $reservation->user_id,
                'model' => 'reservation',
                'model_id' => $reservation->id,
                'body' => 'تم تغيير حالة طلب اجراء الفحوصات الخاص بك الي ' . $reservation->status,
            ]);
        }

        return redirect()->route('show reservations');
    }

    public function get_reservation(Reservation $reservation)
    {
        if (auth()->user()->id == $reservation->user_id) {
            $reservation->load(['user', 'hospital', 'tests']);
            return response()->json([
                'status' => 'success',
                'reservation' => $reservation,
            ]);
        }
    }
}
