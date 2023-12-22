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
            'doctor' => $doctors
        ]);
    }

    public function show_doctor(Doctor $doctor)
    {

        return response()->json([
            'message' => 'success',
            'doctor' => $doctor
        ]);
    }

    // Edit doctor profile
    public function edit_doctor(Doctor $doctor)
    {

        return response()->json([
            'message' => 'success',
            'doctor' => $doctor->with('profession'),
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
            'phone' => 'required|numeric|max:255',
            'work_at' => 'required|string|max:255',
            'profession' => 'required',
        ]);

        // Update doctor
        $doctor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => $request->bio,
            'phone' => $request->phone,
            'work_at' => $request->work_at,
            'profession_id' => $request->profession
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'doctor profile updated successfully',
            'doctor' => $doctor->with('profession'),
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

        if ($profession != null) {
            $query->whereHas('professions', function ($q) use ($profession) {
                $q->where('name', 'like', '%' . $profession . '%');
            });
        }

        // Apply search query if provided
        if ($name) {
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%')
                    ->orWhere('bio', 'like', '%' . $name . '%')
                    ->orWhereHas('professions', function ($profQuery) use ($name) {
                        $profQuery->where('name', 'like', '%' . $name . '%');
                    });
                // Add more fields to search if needed
            });
        }

        // Retrieve the filtered and searched doctors with their professions
        $doctors = $query->with('professions')->get();

        return response()->json([
            'message' => 'success',
            'doctors' => $doctors
        ]);
    }
}
