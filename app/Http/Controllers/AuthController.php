<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorProfession;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Webpatser\Uuid\Uuid;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login_user', 'login_doctor', 'register_user', 'register_doctor']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = auth('user')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    } //

    public function login_doctor(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = auth('doctor')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $doctor = Auth::doctor();
        return response()->json([
            'status' => 'success',
            'doctor' => $doctor,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    } //

    public function register_user(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'id' => check_uuid('App\Models\User', Uuid::generate()),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send email verification notification
        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'User registered successfully. Check your email for verification.']);
    } //

    // Doctor registration
    public function register_doctor(Request $request)
    {
        // Validate doctor input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:admins|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new admin
        $doctor = Doctor::create([
            'id' => check_uuid('App\Models\Doctor', Uuid::generate()),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $professions = Profession::where('id', $request->profession)->get();

        foreach ($professions as $profession) {
            $doctor_profession = DoctorProfession::create([
                'doctor_id' => $doctor->id,
                'profession_id' => $profession->id
            ]);
        }

        $doctor->sendEmailVerificationNotification();

        return response()->json(['message' => 'Doctor registered successfully.']);
    } //

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    } //

    public function refresh()
    {
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    } //
}
