<?php

namespace App\Repositories\Service;

use App\Repositories\BaseRepository;
use App\Service;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    /**
     * @var ModelName
     */
    protected $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function getAllService()
    {
        return $this->model->all();
    }

    public function getServiceId($id)
    {
        return $this->model->find($id);
    }

    public function createOrUpdate($id = null, array $data)
    {
        if (is_null($id)) {
            $service = $this->model->create($data);
            return $service;
        } else {
            $service = $this->model->find($id);
            return $service->update($data);
        }
    }

    public function deleteService($id)
    {
        return $this->model->destroy($id);
    }
}
