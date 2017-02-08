<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'id_gender' => 'sometimes|in:1,2|required',
            'id_lang' => 'sometimes|in:1,2',
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'email' => 'required|email',
            'passwd' => 'required|min:6',
            'newsletter' => 'sometimes|boolean',
            'birthday' => 'sometimes|date',
        ];
    }
}
