<?php

namespace DanPowell\Jellies\Encounters;

class NothingEncounter implements EncounterInterface
{

    private $minions;
    private $enemies;
    private $creatures;

    private $log;

    private $victory = true;
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
