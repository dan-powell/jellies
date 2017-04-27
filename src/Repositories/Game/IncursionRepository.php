<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Incursion;

use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\UserRepository;

class IncursionRepository extends AbstractModelRepository
{

    private $minionRepo;
    private $userRepo;

    public function __construct(MinionRepository $minionRepo, UserRepository $userRepo)
    {
        $this->model = new Incursion();

        $this->minionRepo = $minionRepo;
        $this->userRepo = $userRepo;
    }

    public function query($with = [])
    {
        return auth()->user()->incursions();
    }

    public function store($minions)
    {
        // Get the minions
        $minions = $this->minionRepo->query()->find($minions);

        // Check if the user has enough points
        if(auth()->user()->points >= config('jellies.incursion.cost')) {

            // Create a new incursion
            $this->incursion = new Incursion();
            // Assign to user
            $this->incursion->user_id = auth()->user()->id;
            $this->incursion->save();
            // Assign Minions
            $this->incursion->minions()->attach($minions);

            // Spend points
            $this->userRepo->subtractPoints(config('jellies.incursion.cost'));

            return $this->incursion;
        } else {
            return false;
        }

    }

    public function destroy($id)
    {
        $incursion = $this->query()->find($id);

        $points = $incursion->points;

        $incursion->delete();

        $this->userRepo->addPoints($points);

        return $incursion;

    }



}
