<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // "id": 583,
        //     "name": "Prof. Jayme Stokes",
        //     "email": "mbergnaum@example.com",
        //     "email_verified_at": "2024-04-20T08:30:55.000000Z",
        //     "created_at": "2024-04-20T08:30:58.000000Z",
        //     "updated_at": "2024-04-20T08:30:58.000000Z"

        // return parent::toArray($request);
        return ([
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,

        ]);
    }
}
