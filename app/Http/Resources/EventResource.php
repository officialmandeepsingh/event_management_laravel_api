<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //"id": 2,
        // "name": "Corrupti aut quisquam tempora.",
        // "description": "Eum doloribus sequi libero adipisci sint dolor. Nihil inventore ipsum et iure ab harum distinctio. Voluptatum suscipit atque fuga tenetur. Enim quibusdam qui minima dolorum eum officia.",
        // "user_id": 384,
        // "start_time": "2024-05-04 08:07:47",
        // "end_time": "2024-07-10 23:13:39",
        // "created_at": "2024-04-20T08:30:59.000000Z",
        // "updated_at": "2024-04-20T08:30:59.000000Z"

        // return parent::toArray($request);
        return ([
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'user' => new UserResource($this->whenLoaded('user') ?? []),
            'attendees' => AttendeeResource::collection($this->whenLoaded('attendees')),
        ]);
    }
}
