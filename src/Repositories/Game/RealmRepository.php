<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Realm;
use DanPowell\Jellies\Repositories\Game\ZoneRepository;
use DanPowell\Jellies\Repositories\Game\MaterialRepository;

class RealmRepository extends AbstractModelRepository
{

    private $zoneRepo;

    public function __construct(ZoneRepository $zoneRepo, MaterialRepository $materialRepo)
    {
        $this->model = new Realm();
        $this->zoneRepo = $zoneRepo;
        $this->materialRepo = $materialRepo;
    }

    // Returns the first
    public function getFirstZone($realm_id)
    {
        return $this->zoneRepo->query()->where('realm_id', $realm_id)->where('number', 1)->first();
    }

    public function generate($num = 1)
    {

        // Generate some realms
        $realms = factory(\DanPowell\Jellies\Models\Game\Realm::class, $num)->create();

        $materials = $this->materialRepo->query()->get();

        foreach($realms as $realm) {

            // Generate some zones
            $zones = [];
            for($i=1; $i <= 10; $i++) {
                $zones[] = factory(\DanPowell\Jellies\Models\Game\Zone::class)->make([
                    'number' => $i,
                    'level' => $i * 10
                ]);
            }

            // Save 'em
            foreach($zones as $zone) {
                $realm->zones()->save($zone);

                $points = $zone->level;
                $stats_array = config('jellies.minion.stats');
                $distribution = app('MiscHelper')->distributePoints(count($stats_array), $points);
                $stats = [];
                for($i = 0; $i < count($stats_array); $i++) {
                    $stats[$stats_array[$i]] = $distribution[$i] + 1;
                }

                // Assign some materials
                $zone_materials = $materials->random(rand(1, 3));
                $zone->materials()->attach($zone_materials);

                //Add some enemies
                for($i=0; $i < rand(1,3); $i++) {
                    $enemy = $zone->enemies()->save(factory(\DanPowell\Jellies\Models\Game\Enemy::class)->make());

                    foreach ($zone_materials as $material) {
                        $enemy->materials()->save($material, ['quantity' => rand(1,3)]);
                    }

                }

            }
        }
    }

/*
    $realms = factory(DanPowell\Jellies\Models\Game\Realm::class, rand(1,4))->create();




*/

}
