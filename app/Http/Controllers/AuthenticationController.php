<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function register()
    {
        return view('auth_register');
    }

    public function postRegister(Request $request)
    {
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8|confirmed',
            'mobile'=>'required|unique:users,mobile'
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        alert('Regitered Successfully!');

        if (!$user) {
            alert('Something is wrong!');
        }

        alert('Registered!');

        Auth::login($user);
        return back();
    }

    public function login()
    {
        return view('auth_login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if (Auth::attempt($data)) {
            return redirect('/');
        }
        return back()->withError('Account not found!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('auth_forgot_password');
    }
    public function sendPasswordResetLink()
    {
        request()->validate([
            'email'=>'required|email'
        ]);


        $user = User::where('email', request()->email)->first();

        if (!$user) {
            alert('Email not found!');
            return back()->withError('Account not found!');
        }
        alert("We've sent you a password reset link!");
        Mail::to($user)->send(new PasswordResetLink($user));
        return redirect('/');
    }

    public function passwordReset()
    {
        if (!request()->hasValidSignature()) {
            abort(401);
        }
        return view('password_reset');
    }

    public function postPasswordReset()
    {
        request()->validate([
            'email'=>'required|email',
            'password'=>'required|confirmed|min:6'
        ]);
        $user = User::where('email', request()->email)->first();

        if (!$user) {
            alert('account not found!');
            return back()->withError('Account not found!');
        }
        //change pasword here
        $user->password = bcrypt(request()->password);
        $user->save();

        //login user
        Auth::login($user);

        alert('Password reset!');
        //redirect to home
        return redirect('/');
    }
}
