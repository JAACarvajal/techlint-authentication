<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\V1\BaseUserRequest;

class LoginUserRequest extends BaseUserRequest
{
    /**
     * Determine if the user is authorized to make this request
     * No authorization check is needed here
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Required ability for the request
     */
    protected function requiredAbility(): string
    {
        return 'login:user';
    }

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
