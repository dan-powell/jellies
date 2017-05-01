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
        $enemies = $this->enemyRepo->getRandomEnemies(rand(1,5));

        $this->model->minions = $minions;
        $this->model->enemies = $enemies;

        $encounterCombat = new EncounterCombat($minions, $enemies);
        $details = $encounterCombat->engage();

        $this->model->fill($details);

        $incursion->encounters()->save($this->model);

        // Update the minions
        $minions->each(function($minion) use ($incursion, $minions) {
            $minion->save();
            if(!$minion->alive) {
                $minion->incursions()->detach($incursion);
                $minion->delete();
            }
        });

    }

}
