<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseUserRequest;

class StoreUserRequest extends BaseUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.first_name'       => 'required|string',
            'data.attributes.last_name'        => 'required|string',
            'data.attributes.email'            => 'required|email|unique:users,email',
            'data.attributes.password'         => 'string',
            'data.attributes.confirm_password' => 'string'
        ];
    }

    public function messages(): array
    {
        return [
            'data.attributes.first_name.required' => 'The data.attributes.first_name field is required.',
            'data.attributes.last_name.required'  => 'The data.attributes.last_name field is required.'
        ];
    }
}
