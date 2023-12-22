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

        $token = auth('api')->attempt($credentials);
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

        $doctor = auth('doctor')->user();
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user
        $user = User::create([
            'id' => check_uuid('App\Models\User', Uuid::generate()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
        ]);

        // Send email verification notification
        // $user->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully. Check your email for verification.'
        ]);
    } //

    // Doctor registration
    public function register_doctor(Request $request)
    {
        // Validate doctor input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'work_at' => 'required|string|max:255',
            'bio' => 'required|string',
            'phone' => 'required|numeric',
            'profession' => 'required',
            'email' => 'required|string|email|unique:doctors|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Create a new admin
        $doctor = Doctor::create([
            'id' => check_uuid('App\Models\Doctor', Uuid::generate()),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'profession_id' => $request->profession,
            'work_at' => $request->work_at,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
        ]);

        // $doctor->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'Doctor registered successfully.'
        ]);
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
