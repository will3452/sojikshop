<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create()
    {
        return view('address_create');
    }
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

        $data['user_id'] = auth()->id();

        Address::create($data);

        return redirect('/profile');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return back();
    }
    public function setDefault(Address $address)
    {
        foreach (auth()->user()->addresses as $xaddress) {
            $xaddress->removeDefault();
        }
        $address->setDefault();
        return back();
    }
}
