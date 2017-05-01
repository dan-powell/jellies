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
    }

    // Returns the first
    public function getFirstZone($realm_id) {

        $realm = $this->query()->with('zones.enemies')->find($realm_id);

        // Sort the zones (Those with less enemy hp first)
        $sorted = $this->getZoneOrder($realm->zones);

        return $sorted->first();
    }


    public function getZoneOrder($zones) {

        // Sort the zones (Those with less enemy hp first)
        $sorted = $zones->sort(function($a, $b) {
            if($a->enemies->sum('hp') == $b->enemies->sum('hp')) {
                return 0;
            }
            return ($a->enemies->sum('hp') < $b->enemies->sum('hp')) ? -1 : 1;
        });

        return $sorted;
    }

}
