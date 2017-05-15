<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Models\Game\Defence;

class DefenceRepository extends AbstractModelRepository
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->model = new Defence();
        $this->userRepo = $userRepo;
    }

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->defences();
    }

    public function store($user_id, $minion_id)
    {



    }
}
