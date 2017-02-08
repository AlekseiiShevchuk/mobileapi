<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Http\Requests\AddressDeleteRequest;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Requests\AddressUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AddressController
 * @package App\Http\Controllers
 * @resource Address
 */
class AddressController extends Controller
{
    /**
     * User Addresses
     * @return \Illuminate\Http\Response
     */
    public function getUserAddresses()
    {
        return ['data'=>Address::getUserAddresses(Auth::user()->id_customer)];
    }

    /**
     * Country List
     * @return \Illuminate\Http\Response
     */
    public function getCountriesList()
    {
        return ['data' => Address\AddressCountry::where('active', '=', true)->get()];
    }

    /**
     * State list by Country
     * @param  Address\AddressCountry $country
     * @return \Illuminate\Http\Response
     */
    public function getStateList(Address\AddressCountry $country)
    {
        return ['data' => Address\AddressState::where('id_country', '=', $country->id_country)->get()];
    }

    /**
     * Create Address
     *
     * @param  AddressStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressStoreRequest $request)
    {
        $data = $request->all();
        $address = new Address($data);
        $address->country()->associate($data['id_country']);

        if (isset($data['id_state'])) {
            $address->state()->associate($data['id_state']);
        }
        $address->customer()->associate(Auth::user());
        $address->save();
        return $address;

    }

    /**
     * Update Address
     *
     * @param  AddressUpdateRequest $request
     * @param  Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressUpdateRequest $request, Address $address)
    {
        $address->update($request->all());
        $address->country()->associate($request->get('id_country'));

        if (isset($data['id_state'])) {
            $address->state()->associate($request->get('id_state'));
        }
        $address->save();
        return $address;
    }

    /**
     * Delete Address
     *
     * @param  AddressDeleteRequest $request
     * @param  Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressDeleteRequest $request, Address $address)
    {
        $address->deleted = 1;
        $address->save();
        return response('', 204);
    }
}
