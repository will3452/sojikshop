<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function myProfile()
    {
        return view('my_profile');
    }

    public function saveProfile(){
        if(request()->has('picture')){
            $newPicture = request()->picture->store('public');
            auth()->user()->update([
                'picture'=>$newPicture,
            ]);
        }

        if(request()->has('password')){
            $newpassword = bcrypt(request()->password);
            auth()->user()->update([
                'password'=>$newpassword
            ]);
        }

        if(request()->has('address')){
            auth()->user()->update([
                'address'=>request()->address
            ]);
        }

        if(request()->has('name')){
            auth()->user()->update([
                'name'=>request()->name
            ]);
        }

        if(request()->has('mobile')){
            auth()->user()->update([
                'mobile'=>request()->mobile
            ]);
        }

        alert('Profile updated!', 'success');
        return back();
    }
}
