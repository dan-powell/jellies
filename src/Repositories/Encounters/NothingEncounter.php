<?php

namespace DanPowell\Jellies\Repositories\Encounters;

use DanPowell\Jellies\Repositories\Encounters\AbstractEncounter;

class NothingEncounter extends AbstractEncounter
{

    private $minions;
    private $enemies;
    private $creatures;

    private $enemyRepo;

    private $log;

    private $victory = false;
    private $enemy_damage = 0;
    private $minion_damage = 0;
    private $rounds = 0;
    private $points = 0;

    public function __construct()
    {

    }

    public function engage($incursion) {

        return [
            'log' => $this->log,
            'victory' => $this->victory,
            'minion_damage' => $this->minion_damage,
            'enemy_damage' => $this->enemy_damage,
            'rounds' => $this->rounds,
            'points' => $this->points,
        ];
    }

}
