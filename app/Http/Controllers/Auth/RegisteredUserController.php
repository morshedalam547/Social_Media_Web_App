<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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
                'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
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
                'name.regex' => 'Name field এ শুধু Letter, Number আর Space ব্যবহার করা যাবে।',
                'email.email' => 'সঠিক email address দিন।',
                'password.confirmed' => 'Password and Confirm Password do not match.',
                'password.min' => 'Password must be at least 8 characters.',
            ]);

            // dd($request->all());
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            notifySuccess('Registration Successfully.');

            return redirect()->route('login');

        } catch (ValidationException $e) {

            return back()->withErrors($e->errors())->withInput()->with('register_errors', true);
        }
    }

}
