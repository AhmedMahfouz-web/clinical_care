<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorProfession;
use App\Models\Profession;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function show_all_doctors()
    {
        $doctors = Doctor::all();

        return response()->json([
            'message' => 'success',
            'doctor' => $doctors
        ]);
    }

    public function show_all_doctors_home()
    {
        $doctors = Doctor::take(6)->get();

        return response()->json([
            'message' => 'success',
            'doctors' => $doctors
        ]);
    }

    public function show_doctor(Doctor $doctor)
    {
        return response()->json([
            'message' => 'success',
            'doctor' => $doctor
        ]);
    }

    public function profile()
    {
        $doctor = auth()->guard('doctor')->user();
        return response()->json([
            'status' => 'success',
            'doctor' => $doctor
        ]);
    }

    // Edit doctor profile
    public function edit_doctor()
    {
        $doctor = auth()->guard('doctor')->user();
        $professions = Profession::all();
        return response()->json([
            'message' => 'success',
            'doctor' => $doctor,
            'professions' => $professions,
        ]);
    }

    // Update doctor profile
    public function update_doctor(doctor $doctor, Request $request)
    {

        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'bio' => 'required|string',
            'phone' => 'required|numeric',
            'work_at' => 'required|string|max:255',
            'profession' => 'required',
        ]);
        if ($doctor->id == auth()->guard('doctor')->user()->id) {
            // Update doctor
            $doctor->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'bio' => $request->bio,
                'phone' => $request->phone,
                'work_at' => $request->work_at,
                'profession' => $request->profession,
                'degree' => $request->degree
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'doctor profile updated successfully',
            'doctor' => $doctor,
        ]);
    }

    // Destroy (delete) doctor profile
    public function destroy_doctor(Doctor $doctor)
    {
        // Delete doctor
        $doctor->delete();

        return response()->json(['message' => 'doctor profile deleted successfully']);
    }

    // Search Doctors
    public function search($name, $profession)
    {

        // Start with a base query
        $query = Doctor::query();

        if ($profession != 'null') {
            $query->where('profession', 'like', '%' . $profession . '%');
        }

        // Apply search query if provided
        if ($name != 'null') {
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%')
                    ->orWhere('bio', 'like', '%' . $name . '%')
                    ->orWhere('profession', 'like', '%' . $name . '%');

                // Add more fields to search if needed
            });
        }

        // Retrieve the filtered and searched doctors with their professions
        $doctors = $query->get();

        return response()->json([
            'status' => 'success',
            'doctors' => $doctors
        ]);
    }
}
