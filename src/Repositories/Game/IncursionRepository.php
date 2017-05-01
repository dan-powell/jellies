<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Incursion;

use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Game\RealmRepository;
use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Helpers\Message;

class IncursionRepository extends AbstractModelRepository
{

    private $minionRepo;
    private $realmRepo;
    private $zoneRepo;
    private $userRepo;

    public function __construct(MinionRepository $minionRepo, RealmRepository $realmRepo, ZoneRepository $zoneRepo, UserRepository $userRepo)
    {
        $this->model = new Incursion();

        $this->minionRepo = $minionRepo;
        $this->realmRepo = $realmRepo;
        $this->zoneRepo = $zoneRepo;
        $this->userRepo = $userRepo;
    }

    public function query($with = [])
    {
        return auth()->user()->incursions();
    }

    public function store($minions, $realm_id)
    {
        // Get the minions
        $minions = $this->minionRepo->query()->find($minions);

        // Get realm
        $zone = $this->realmRepo->getFirstZone($realm_id);

        // Check if the user has enough points
        if(auth()->user()->points >= config('jellies.incursion.cost')) {

            // Create a new incursion
            $this->incursion = new Incursion();

            // Assign to user
            $this->incursion->user_id = auth()->user()->id;

            // Save incursion
            $zone->incursions()->save($this->incursion);

            // Assign Minions
            $this->incursion->minions()->attach($minions);

            // Spend points
            $this->userRepo->subtractPoints(config('jellies.incursion.cost'));

            app('message')->basic('Incursion Started', '');



            return $this->incursion;
        } else {
            return false;
        }

    }


    public function proceed($id)
    {
        // Get the incursion
        $incursion = $this->query()->with('previous_zones')->find($id);

        $last = $incursion->previous_zones->last();

        $next_zone = $this->zoneRepo->getNextZone($last);

        if($next_zone) {
            $incursion->zone_id = $next_zone->id;
            $incursion->save();
            return true;
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
