<?php

namespace App\Http\Resources\V1;

use App\Concerns\AuthMetadata;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    use AuthMetadata;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'attributes' => [
                'token' => $this->resource,
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request Request instance
     */
    public function with(Request $request): array
    {
        return [
            'meta' => $this->withAuthMetadata($request),
        ];
    }
}
