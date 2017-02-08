<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddressUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('address')->id_customer == Auth::user()->id_customer;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_country' => 'required|integer',
            'id_state'=>'sometimes|integer',
            'alias' => 'required|max:32',
            'company' => 'sometimes|max:64',
            'lastname' => 'required|max:32',
            'firstname' => 'required|max:32',
            'address1' => 'required|max:128',
            'address2' => 'sometimes|max:128',
            'postcode' => 'required|max:12',
            'city' => 'required|max:64',
            'phone' => 'max:32|required_if:phone_mobile,',
            'phone_mobile' => 'max:32|required_if:phone,'
        ];
    }
}
