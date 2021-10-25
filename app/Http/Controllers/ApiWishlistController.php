<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;

class ApiWishlistController extends Controller
{
    public function getWishlists()
    {
        $user = User::find(auth()->user()->id);
        $wishlists = $user->wishlists;
        $wishlists->load('product');
        return response([
            'wishlists'=>$wishlists
        ], 200);
    }

    public function addToWishList()
    {
        WishList::create([
            'product_id'=>request()->product_id,
            'user_id'=>auth()->user()->id,
        ]);

        return response([
            'result'=>'success'
        ], 200);
    }

    public function removeToWishList()
    {
        WishList::find(request()->wishlist_id)->delete();

        return response([
            'result'=>'success'
        ], 200);
    }
}
