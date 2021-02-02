<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = 'destinations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'destination_name',
        'price',
        'description',
        'maps_url'
    ];

    public function resourceDestination()
    {
        return $this->hasMany(ResourceDestination::class);
    }

    public function destinationMedia()
    {
        return $this->hasMany(DestinationMedia::class);
    }

    public function fieldResourceDestination()
    {
        return $this->hasMany(ResourceDestination::class)
            ->join('services', 'resource_destinations.service_id', 'services.id')
            ->select(['destination_id', 'services.service_name']);
    }

    public function getDestinationWithResource($id)
    {
        return $this->hasMany(ResourceDestination::class)
            ->where('resource_destinations.destination_id', $id)
            ->join('services', 'resource_destinations.service_id', 'services.id')
            ->select(['destination_id', 'services.service_name']);
    }

    public function services()
    {
        return $this->ResourceDestination->hasMany(Service::class);
    }
}
