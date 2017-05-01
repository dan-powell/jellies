<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Repositories\Game\RealmRepository;

use DanPowell\Jellies\Models\Game\Zone;

class ZoneRepository extends AbstractModelRepository
{



    public function __construct()
    {
        $this->model = new Zone();

    }

    public function getNextZone($zone, $zones = null) {

        $num = $zone->number;

        if(!$zones) {
            $zones = $zone->realm->zones;
        }

        $next_zone = $zones->where('number', $num+1);

        return $next_zone->first();
    }

    public function getZoneOrder($zones) {

        // Sort the zones (Those with less enemy hp first)
        return $zones->sortBy('number');
    }


}
