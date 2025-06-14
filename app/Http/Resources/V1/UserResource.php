<?php

namespace App\Http\Resources\V1;

use App\Concerns\AuthMetadata;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'user',
            'id'   => $this->id,
            'attributes' => [
                'email'      => $this->email,
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'is_admin'   => $this->is_admin ?? false,
                $this->mergeWhen(
                    $request->routeIs('auth.check'),
                    [
                        'permissions' => $this->permissions,
                    ]
                ),
                $this->mergeWhen(
                    $request->routeIs('users.*'),
                    [
                        'created_at' => $this->created_at,
                        'updated_at' => $this->updated_at
                    ]
                ),
            ]
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
