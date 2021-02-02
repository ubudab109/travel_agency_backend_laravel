<?php

namespace App\Http\Resources\Destination;

use App\Repositories\ResourcesAllDestination\ResourcesDestinationInterfaceAll;
use App\Repositories\ResourcesAllDestination\ResourcesDestinationRepositoryAll;
use App\ResourceDestination;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->fieldResourceDestination;
        $media = $this->destinationMedia;
        $image = [];
        $service = [];
        foreach ($resource as $val) {
            if ($val['service_name'] != null) {
                array_push($service, $val['service_name']);
            }
        }
        foreach ($media as $val) {
            if ($val['images_destination'] != null) {
                array_push($image, $val['images_destination']);
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->destination_name,
            'price' => $this->price,
            'maps' => $this->maps_url,
            'image' => $image,
            'service' => $service,
        ];
    }
}
