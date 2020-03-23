<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'size' => $this->size,
            'website' => $this->website,
            'logo' => $this->getLogo(),
            'link' => route('employer.show', $this->slug),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
