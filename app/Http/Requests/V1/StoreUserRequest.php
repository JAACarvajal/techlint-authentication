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
            'data.attributes.first_name' => 'required|string',
            'data.attributes.last_name'  => 'required|string',
            'data.attributes.email'      => 'required|email|unique:users,email',
            'data.attributes.password'   => 'required|string',
        ];
    }

    /**
     * Override attributes
     */
    public function attributes(): array
    {
        return [
            'data.attributes.first_name' => 'first name',
            'data.attributes.last_name'  => 'last name',
            'data.attributes.email'      => 'email address',
            'data.attributes.password'   => 'password',
        ];
    }
}
