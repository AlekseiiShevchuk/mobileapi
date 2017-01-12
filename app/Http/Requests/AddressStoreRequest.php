<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_country' => 'required|integer|exists:clk_1d21ac51df_country,id_country',
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