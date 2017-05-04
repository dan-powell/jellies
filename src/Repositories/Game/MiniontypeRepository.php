<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Miniontype;

class MiniontypeRepository extends AbstractModelRepository
{

    public function __construct()
    {
        $this->model = new Miniontype();
    }

}
