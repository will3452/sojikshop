<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthenticationController extends Controller
{
    public function generateToken($user)
    {
        $token = $user->createToken('my-app');
        return $token->plainTextToken;
    }

    public function login()
    {
        $data = request()->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!is_null($user)) {

            //if the user password is correct
            if (Hash::check($data['password'], $user->password)) {
                return response([
                    'token'=>$this->generateToken($user),
                    'user'=>$user
                ], 200);
            }

            //if not
            return response([
                'error'=>'credential not found.'
            ], 404);
        }

        return response([
            'error'=>'account not found',
        ], 404);
    }

    public function register()
    {
        $data = request()->validate([
            'name'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response([
            'token'=>$this->generateToken($user),
            'user'=>$user
        ], 200);
    }
}
