<?php

namespace App\Repositories\Service;

interface ServiceRepositoryInterface
{
    public function getAllService();
    public function getServiceId($id);
    public function createOrUpdate($id = null, array $data);
    public function deleteService($id);
}
