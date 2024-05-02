<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        /* {
            "id": 10,
            "user_id": 6,
            "event_id": 4,
            "created_at": "2024-04-20T08:31:00.000000Z",
            "updated_at": "2024-04-20T08:31:00.000000Z"
        } */
        // return parent::toArray($request);
        return ([
            "id" => $this->id,
            'user_id' => $this->user_id,
            'event_id' => $this->event_id,
            'user' => new UserResource($this->whenLoaded('user') ?? []),
        ]);
    }
}
