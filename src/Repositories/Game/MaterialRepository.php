<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Material;

class MaterialRepository extends AbstractModelRepository
{

    public function __construct()
    {
        $this->model = new Material();
    }

}
