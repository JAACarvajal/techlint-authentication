<?php

namespace App\Http\Requests;

use App\Concerns\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    use ApiResponse;

    /**
     * Handle a failed authorization attempt
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization(): never
    {
        throw new AuthorizationException('This action is unauthorized.');
    }
}
