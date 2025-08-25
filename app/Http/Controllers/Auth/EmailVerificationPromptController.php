<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailVerificationPromptController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * এই controller টা invokable, তাই __invoke() method থাকতে হবে।
     */
    public function __invoke(Request $request)
    {
        // যদি user already verified থাকে → home এ redirect করো
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        // নাহলে verify-email.blade.php view দেখাও
        return view('auth.verify-email');
    }
}
