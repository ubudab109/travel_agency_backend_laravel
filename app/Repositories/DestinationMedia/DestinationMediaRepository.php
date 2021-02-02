<?php

namespace App\Repositories\DestinationMedia;

use App\DestinationMedia;
use App\Repositories\BaseRepository;

class DestinationMediaRepository extends BaseRepository implements DestinationMediaInterface
{
    /**
     * @var ModelName
     */
    protected $model;

    public function __construct(DestinationMedia $model)
    {
        $this->model = $model;
    }

    public function getMediaDestination($destination_id)
    {
        return $this->model->where('destination_id', $destination_id);
    }

    public function createOrUpdateMedia($destination_id = null, $media)
    {
        if (is_null($destination_id)) {
            $model = $this->model->create($media);
            return $model;
        } else {
            $media = $this->model->where('destination_id', $destination_id);
            return $media->update($media);
        }
    }
}
