<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Realm;

class RealmRepository extends AbstractModelRepository
{

    private $zoneRepo;

    public function __construct()
    {
        $this->model = new Realm();
    }


}
