<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiProfileController extends Controller
{
    public function getProfile()
    {
        return response([
            'profile' => auth()->user(),
        ], 200);
    }

    public function getProfileDemo()
    {
        return response([
            'profile' => User::find(1),
        ], 200);
    }

    public function saveProfile()
    {
        if (request()->has('picture')) {
            $newPicture = request()->picture->store('public');
            auth()->user()->update([
                'picture'=>$newPicture,
            ]);
        }

        if (request()->has('password')) {
            $newpassword = bcrypt(request()->password);
            auth()->user()->update([
                'password'=>$newpassword
            ]);
        }

        if (request()->has('address')) {
            auth()->user()->update([
                'address'=>request()->address
            ]);
        }

        if (request()->has('name')) {
            auth()->user()->update([
                'name'=>request()->name
            ]);
        }

        if (request()->has('mobile')) {
            auth()->user()->update([
                'mobile'=>request()->mobile
            ]);
        }

        return response([
            'profile' => auth()->user(),
        ], 200);
    }
}
