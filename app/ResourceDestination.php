<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Destination;

class ResourceDestination extends Model
{
    protected $table = 'resource_destinations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'destination_id',
        'service_id',
        'destination_image'
    ];

    public function destinations()
    {
        return $this->belongsTo(Destination::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
