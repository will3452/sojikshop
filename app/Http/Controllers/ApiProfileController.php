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
}
