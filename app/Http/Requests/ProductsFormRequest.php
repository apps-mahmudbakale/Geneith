<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'         => [
                'required',
                'string'
            ],
            'store_id' => [
                'integer',
                'required'
            ],
            'buying_price' => [
                'integer',
                'required'
            ],
            'selling_price' => [
                'integer',
                'required'
            ],
            'qty' => [
                'integer',
                'required'
            ],
            'expiry_date' => [
                'required'
            ]
        ];
    }
}
