<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Enemy;

class EnemyRepository extends AbstractModelRepository
{

    public function __construct()
    {
        $this->model = new Enemy();
    }

    // Returns a random collection of enemies
    public function getRandomEnemies($num = 1) {

        $types = $this->query()->get();

        $enemies = collect([]);

        for($i=0; $i < $num; $i++) {
            $enemies->push($types->random());
        }

        return $enemies;
    }

}
