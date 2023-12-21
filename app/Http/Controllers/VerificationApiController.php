<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationApiController extends Controller

{
    public function __invoke(EmailVerificationRequest $request)
    {
        $request->fulfill();

        event(new Verified($request->user()));

        return redirect()->to('/home'); // Redirect to your desired location
    }
}
