<?php

namespace DanPowell\Jellies\Repositories;

abstract class AbstractModelRepository
{

    protected $model;

    // Get all if owned by user
    public function query()
    {
        return $this->model;
    }

    // Get any, regardless of ownership
    public function queryAll()
    {
        return $this->model->withoutGlobalScopes();
    }

}
