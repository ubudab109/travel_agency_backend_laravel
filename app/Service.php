<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = [
        'service_name',
        'logo',
    ];

    public function toResourceDestinationService()
    {
        return $this->hasMany(ResourceDestination::class);
    }

    /**
     * Set the categories
     *
     */
    public function setCatAttribute($value)
    {
        $this->attributes['service_name'] = json_encode($value);
    }

    /**
     * Get the categories
     *
     */
    public function getCatAttribute($value)
    {
        return $this->attributes['service_name'] = json_decode($value);
    }
}
