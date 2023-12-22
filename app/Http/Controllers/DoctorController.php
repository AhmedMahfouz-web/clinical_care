<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorProfession;
use App\Models\Profession;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
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
    public function searchDoctors(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255'
        ]);

        // Start with a base query
        $query = Doctor::query();

        if ($request->filled('profession')) {
            $query->whereHas('professions', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('profession') . '%');
            });
        }

        // Apply search query if provided
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('bio', 'like', '%' . $request->input('search') . '%')
                    ->orWhereHas('professions', function ($profQuery) use ($request) {
                        $profQuery->where('name', 'like', '%' . $request->input('search') . '%');
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
