<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiCartController extends Controller
{
    public function myCart()
    {
        $user = User::find(auth()->id());

        $carts = $user->carts;

        return response([
            'carts'=>$carts
        ], 200);
    }
}
