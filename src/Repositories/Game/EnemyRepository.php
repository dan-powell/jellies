<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Repositories\Game\ZoneRepository;

use DanPowell\Jellies\Models\Game\Enemy;

class EnemyRepository extends AbstractModelRepository
{

    private $zoneRepo;

    public function __construct(ZoneRepository $zoneRepo)
    {
        $this->model = new Enemy();
        $this->zoneRepo = $zoneRepo;
    }

    // Returns a random collection of enemies
    public function getRandomEnemies($num = 1, $zone_id = null) {

        if($zone_id) {
            $zone = $this->zoneRepo->query()->with('enemies')->find($zone_id);
            $types = $zone->enemies;
        } else {
            $types = $this->query()->get();
        }

        $enemies = collect([]);

        for($i=0; $i < $num; $i++) {
            $enemies->push($types->random());
        }

        return $enemies;
    }


    // Returns a random collection of enemies
    public function getRandomEnemy($zone_id = null) {

        if($zone_id) {
            $zone = $this->zoneRepo->query()->with('enemies')->find($zone_id);
            $enemies = $zone->enemies;
        } else {
            $enemies = $this->query()->get();
        }

        return $enemies->random();
    }


}
