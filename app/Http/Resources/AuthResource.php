<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return ([
            "id" => $this[0]->id,
            "name" => $this[0]->name,
            "email" => $this[0]->email,
            "email_verified_at" => $this[0]->email_verified_at,
            "api_token" => $this[1],
        ]);
    }
}
