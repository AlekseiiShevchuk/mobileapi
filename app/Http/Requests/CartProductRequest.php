<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/8/17
 * Time: 4:55 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CartProductRequest extends FormRequest
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
            'id_product_attribute' => 'sometimes|integer',
            'quantity'=>'sometimes|integer'
        ];
    }
}
