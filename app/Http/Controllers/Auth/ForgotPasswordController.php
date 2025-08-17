<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

       if ($status === Password::RESET_LINK_SENT) {
        
            notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->duration(3000) // 3 seconds
            ->success('Password Reset Link Sent Successfully.');
            
        return back();
    } else {
        return back()->withErrors(['email' => __($status)]);
    }
}
}