<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read App\Models\User $resource
 */
final class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id'=> $this->resource->id,
          'name'=> $this->resource->name,
          'last_name'=> $this->resource->last_name,
          'email'=> $this->resource->email,
          'gender'=> $this->resource->gender,
          'age'=> $this->resource->age,
        ];
    }
}
