<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Arr;

abstract class BaseUserRequest extends BaseRequest
{
    /**
     * Allowed attributes for the request
     *
     * @var array
     */
    protected array $allowedAttributes = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * Allowed query parameters for the request
     * @var array
     */
    protected array $allowedQueryParams = [];

    /**
     * Map the validated attributes to the allowed attributes
     */
    public function mappedAttributes(): array
    {
        $attributes = $this->input('data.attributes');

        return Arr::only($attributes, $this->allowedAttributes);
    }

    /**
     * Map the validated query parameters to the allowed query parameters
     */
    public function mappedQueryParameters(): array
    {
        $queryParams = $this->validated();

        return Arr::only($queryParams, $this->allowedQueryParams);
    }
}
