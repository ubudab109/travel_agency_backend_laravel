<?php

namespace App\Repositories\Destination;


interface DestinationRepositoryInterface
{
    public function getAllDestination();

    public function getDestinationId($id);

    public function createOrUpdateDestination($id = null);
}
