<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Encounter;

use DanPowell\Jellies\Repositories\Game\EnemyRepository;
use DanPowell\Jellies\Helpers\EncounterCombat;

class EncounterRepository extends AbstractModelRepository
{

    private $minionRepo;
    private $userRepo;
    private $enemyRepo;

    public function __construct(EnemyRepository $enemyRepo)
    {
        $this->model = new Encounter();

        $this->enemyRepo = $enemyRepo;
    }

    public function encounter($incursion)
    {
        // Setup
        $minions = $incursion->minions;

        $enemies = $this->enemyRepo->getRandomEnemies(rand(1,5), $incursion->zone->id);

        $this->model->minions_before = $minions;
        $this->model->enemies = $enemies;
        $this->model->zone_id = $incursion->zone->id;

        $encounterCombat = new EncounterCombat($minions, $enemies);
        $details = $encounterCombat->engage();

        $this->model->fill($details);

        $this->model->minions_after = $minions;

        $incursion->encounters()->save($this->model);

        // Update the minions
        $minions->each(function($minion) use ($incursion, $minions) {
            $minion->save();
            if(!$minion->alive) {
                $minion->incursions()->detach($incursion);
                $minion->delete();
            }
        });

        $this->postEncounterCheck($incursion);
    }

    private function postEncounterCheck($incursion)
    {
        if(count($incursion->encounters->where('zone_id', $incursion->zone->id)) >= $incursion->zone->size) {
            $incursion->previous_zones()->attach($incursion->zone);

            $incursion->zone_id = null;

            if (count($incursion->previous_zones) >= 10) {
                $incursion->complete = true;
            }

            $incursion->save();

            if(isset($incursion->user)) {
                app('message')->basic('Incursion zone completed', '', $incursion->user->id);
            }

        }

    }

}
