<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string','lowercase','email','max:255','unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ], [
            'password.confirmed' => 'Password and Confirm Password do not match.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    flash()
    ->option('position', 'top-left')  
    ->option('timeout', 5000)           
    ->option('rtl', true)            
    ->success('Registration Successful. Please login.');
       
        return redirect()->route('login');

    } catch (\Illuminate\Validation\ValidationException $e) {
   
        return back()->withErrors($e->errors())->withInput()->with('register_errors', true);
    }
}

}
