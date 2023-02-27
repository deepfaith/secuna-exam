<?php

namespace App\Traits;

trait RepositoryTrait
{
    /**
     * Model to be used.
     *
     * @var object
     */
    protected $model;

    /**
     * Model Resource to be used.
     *
     * @var object
     */
    protected $modelResource;

    /**
     * @return object
     */
    protected function getModel()
    {
        return $this->model;
    }

    /**
     * @param object $model
     */
    protected function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return object
     */
    protected function getModelResource()
    {
        return $this->modelResource;
    }

    /**
     * @param object $modelResource
     */
    protected function setModelResource($modelResource)
    {
        $this->modelResource = $modelResource;
    }

}
