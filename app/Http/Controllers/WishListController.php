<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function addToWishList(Product $product)
    {
        WishList::create([
            'product_id'=>$product->id,
            'user_id'=>auth()->id(),
        ]);

        alert('Product has been added to your wishlist!', 'success');
        return back();
    }

    public function myWishList()
    {
        $wishlists = auth()->user()->wishLists()->with('product')->latest()->get();

        return view('wish_list', compact('wishlists'));
    }

    public function removeWishList(WishList $wishList)
    {
        $wishList->delete();
        return back();
    }
}
