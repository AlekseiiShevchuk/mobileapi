<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Http\Requests\AddressDeleteRequest;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Requests\AddressUpdateRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAuthUserAddresses()
    {
        return Address::getAuthUserAddresses();
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountriesList()
    {
        return Address::getCountriesList();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressStoreRequest $request)
    {
        $address = Address::create($request->all());
        $freshAddressFromDb = Address::find($address->id_address);

        return $freshAddressFromDb;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AddressUpdateRequest $request
     * @param  Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {

        $address->update($request->all());
        $freshAddressFromDb = Address::find($address->id_address);

        return $freshAddressFromDb;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AddressDeleteRequest $request
     * @param  Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressDeleteRequest $request, Address $address)
    {
        $address->delete();
        return response('',204);
    }
}
