<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DestinationMedia extends Model
{
    protected $table = 'destination_media';
    protected $fillable = [
        'destination_id',
        'images_destination'
    ];

    public function hasManyDestinationId()
    {
        return $this->belongsTo(Destination::class);
    }
}
