<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::all();

        return view('pages.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('pages.hospitals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|numeric|max:255',
            'bio' => 'required|string|max:255',
        ]);

        Hospital::create([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        return redirect()->route('show hospitals')->with('success', 'تم اضافة المشفي بنجاح');
    }

    public function edit(Hospital $hospital)
    {
        return view('pages.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $hospital->update([
            'name' => $request->name,
            'type' => $request->type,
            'address' => $request->address,
            'phone' => $request->phone,
            'city' => $request->city,
            'bio' => $request->bio,
        ]);

        return redirect()->route('show hospitals')->with('success', 'تم تعديل المشفي بنجاح');
    }

    public function destroy(Request $request, Hospital $hospital)
    {
        $hospital->delete();

        return redirect()->route('show hospitals')->with('success', 'تم حذف المشفي بنجاح');
    }
}
