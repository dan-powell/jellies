<?php

namespace DanPowell\Jellies\Repositories\Logic;

use DanPowell\Jellies\Repositories\Logic\DamageLogicInterface;

class DamageLogic implements DamageLogicInterface
{

    private $attacker;
    private $defender;

    public function __construct()
    {

    }

    public function damage($attacker, $defender)
    {
        // Resolve attack
        if($attacker->getStat('attack') != 0 && $defender->getStat('defence') != 0) {
            $damage = $attacker->getStat('attack') / $defender->getStat('defence');
        } else {
            $damage = 0;
        }

        return $damage;

    }

}
