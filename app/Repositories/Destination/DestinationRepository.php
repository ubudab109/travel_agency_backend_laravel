<?php

namespace App\Repositories\Destination;

use App\Destination;
use App\Repositories\Destination\DestinationRepositoryInterface;
use App\Repositories\BaseRepository;

class DestinationRepository extends BaseRepository implements DestinationRepositoryInterface
{
    protected $model;

    public function __construct(Destination $model)
    {
        $this->model = $model;
    }

    public function getAllDestination()
    {
        return $this->model->all();
    }

    public function getDestinationId($id)
    {
        return $this->model->find($id);
    }

    public function createOrUpdateDestination($id = null)
    {
        if (is_null($id)) {
            $destination = $this->model;
            $destination->destination_name;
            $destination->price;
            $destination->description;
            $destination->maps_url;

            return $destination->save();
        } else {
            $destination = $this->model->find($id);
            $destination->destination_name;
            $destination->price;
            $destination->description;
            $destination->maps_url;

            return $destination->save();
        }
    }
}
