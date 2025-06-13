<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseUserRequest;

class LoginUserRequest extends BaseUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.email'    => 'required|email',
            'data.attributes.password' => 'required|string',
        ];
    }
}
