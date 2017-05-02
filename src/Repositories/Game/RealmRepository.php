<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Realm;

use DanPowell\Jellies\Repositories\Game\ZoneRepository;

class RealmRepository extends AbstractModelRepository
{

    private $zoneRepo;

    public function __construct(ZoneRepository $zoneRepo)
    {
        $this->model = new Realm();
        $this->zoneRepo = $zoneRepo;
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

        $realms->each(function($realm) {

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
                $stats_array = config('jellies.enemy.stats');
                $distribution = \Utilities::distributePoints(count($stats_array), $points);
                $stats = [];
                for($i = 0; $i < count($stats_array); $i++) {
                    $stats[$stats_array[$i]] = $distribution[$i] + 1;
                }

                //Generate some enemies
                $enemies = [];
                for($i = 0; $i < rand(10,20); $i++) {
                    $enemies[] = $zone->enemies()->attach(factory(\DanPowell\Jellies\Models\Game\Enemy::class)->create(
                        $stats
                    ));
                }

                // Add some incursions
                $incursions = factory(\DanPowell\Jellies\Models\Game\Incursion::class, rand(0,3))->create();

                $incursions->each(function($i) use ($zone) {
                    // Add some minions
                    $minions = factory(\DanPowell\Jellies\Models\Game\Minion::class, rand(1,10))->create();
                    $i->minions()->attach($minions);

                    $zone->incursions()->save($i);
                });

            };
        });
    }

}
