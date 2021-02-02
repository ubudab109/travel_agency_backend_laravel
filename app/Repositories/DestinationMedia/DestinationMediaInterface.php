<?php

namespace App\Repositories\DestinationMedia;

interface DestinationMediaInterface
{
    public function getMediaDestination($destination_id);

    public function createOrUpdateMedia($destination_id = null, $media);
}
