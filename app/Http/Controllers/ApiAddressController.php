<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class ApiAddressController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'street'=>'required',
            'postal_code'=>'required',
            'barangay'=>'required',
            'city'=>'required',
            'region'=>'required',
            'building'=>'required',
            'house_number'=>'required'
        ]);

        $data['user_id'] = auth()->user()->id;

        $address = Address::create($data);

        return response([
            'address' => $address,
            'profile' => auth()->user(),
            'addresses' => auth()->user()->addresses,
        ], 200);
    }

    public function getAddress()
    {
        $addresses = auth()->user()->addresses;

        return response([
            'addresses' => $addresses,
        ], 200);
    }
}
