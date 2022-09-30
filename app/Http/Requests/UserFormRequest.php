<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
            ],
            'phone'     => [
                'required',
            ],
            'email'    => [
                'required',
                'email'
            ],
             'password'     => [
                'sometimes'
            ],
            'role_id'  => [
                'integer',
                'required'
            ],
            'station_id'  => [
                'integer',
                'required'
            ],
        ];
    }
}
