<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return false;
        }
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
            'id_gender' => 'in:1,2|required',
            'id_lang' => 'sometimes|in:1,2',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:clk_1d21ac51df_customer,email',
            'passwd' => 'required|min:6',
            'newsletter' => 'sometimes|boolean',
            'birthday' => 'sometimes|date',
        ];
    }
}
