<?php

namespace App\Repositories\ResourcesAllDestination;

interface ResourcesDestinationInterfaceAll
{
    public function getAllResources();

    public function createOrUpdate($destination_id = null, $data);
}
