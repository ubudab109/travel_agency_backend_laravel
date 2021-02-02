<?php

namespace App\Repositories\ResourcesAllDestination;

use App\Repositories\BaseRepository;
use App\ResourceDestination;

class ResourcesDestinationRepositoryAll extends BaseRepository implements ResourcesDestinationInterfaceAll
{
    /**
     * @var ModelName
     */
    protected $model;

    public function __construct(ResourceDestination $model)
    {
        $this->model = $model;
    }

    public function getAllResources()
    {
        return $this->model->all();
    }


    public function createOrUpdate($destination_id = null, $data)
    {

        if (is_null($destination_id)) {
            $resources = $this->model->create($data);
            return $resources;
        } else {
            $resources = $this->model->where('destination_id', $destination_id);
            return $resources->update($data);
        }
    }
}
