<?php

namespace App\Http\Resources\ResourcesAllDestination;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceDestinationAll extends JsonResource
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
            'image' => $this->destination_image
        ];
    }
}
