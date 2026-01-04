<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name(),

            'personal_picture' => $this->personal_picture
                                    ? asset(Storage::url($this->personal_picture))
                                    : asset('images/default.jpg'),

            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
        ];
    }
}
