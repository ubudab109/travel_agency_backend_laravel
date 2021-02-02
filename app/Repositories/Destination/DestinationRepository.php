<?php

namespace App\Repositories\Destination;

use App\Destination;
use App\Repositories\Destination\DestinationRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Query\Builder;

class DestinationRepository extends BaseRepository implements DestinationRepositoryInterface
{
    protected $model;

    public function __construct(Destination $model)
    {
        $this->model = $model;
    }

    public function getAllDestination()
    {
        $destination = $this->model->with('fieldResourceDestination', 'destinationMedia')->get();
        return $destination;
    }

    public function getDestinationId($id)
    {
        return $this->model->with('fieldResourceDestination')->findOrFail($id);
    }

    public function createOrUpdateDestination($id = null, $data)
    {
        if (is_null($id)) {
            $destination = $this->model;
            $destination->destination_name = $data['destination_name'];
            $destination->price = $data['price'];
            $destination->description = $data['description'];
            $destination->maps_url = $data['maps_url'];
            $destination->save();
            return $destination;
        } else {
            $destination = $this->model->find($id);
            return $destination->update($data);
        }
    }
}
