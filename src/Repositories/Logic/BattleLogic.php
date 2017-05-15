<?php

namespace DanPowell\Jellies\Repositories\Logic;

use DanPowell\Jellies\Repositories\Logic\BattleLogicInterface;

class BattleLogic implements BattleLogicInterface
{

    private $attacker;
    private $defender;


    public function __construct()
    {

    }

    public function engage($attacker, $defender) {

        if($attacker->attack > $attacker->defence) {
            return true;
        } else {
            return false;
        }
    }

}
