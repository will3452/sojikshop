<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(){
        return view('auth_register');
    }

    public function postRegister(Request $request){
       $data = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:8|confirmed',
            'address'=>'required',
            'mobile'=>'required|unique:users,mobile'
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        alert('Regitered Successfully!');

        if(!$user){
            alert('Something is wrong!', 'danger');
        }

        alert('Registered, succssfully');

        Auth::login($user);
        return back();
    }

    public function login(){
        return view('auth_login');
    }

    public function postLogin(Request $request){
        $data = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($data)){
            return redirect('/');
        }
        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
