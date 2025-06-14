<?php

namespace App\Concerns;

use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;

trait AuthMetadata
{
    /**
     * Get additional metadata for the resource, specifically authentication details
     *
     * @param Request $request Request instance
     */
    public function withAuthMetadata(Request $request): array
    {
        return [
            'auth' => [
                'id' => auth()->user()->id,
            ]
        ];
    }
}
