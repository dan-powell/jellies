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
            $damage = ($attacker->getStat('attack') * $this->getAttackBonus($attacker, $defender)) / $defender->getStat('defence');
        } else {
            $damage = 0;
        }

        return $damage;

    }

    private function getAttackBonus($attacker, $defender)
    {

        $bonus = 1;
        foreach($attacker->getEffectiveAttribute() as $key => $material) {
            if ($defender->materials->pluck('id')->contains($key)) {
                $bonus += 0.25; // 25% Buff
            }
        }

        foreach($attacker->getIneffectiveAttribute() as $key => $material) {
            if ($defender->materials->pluck('id')->contains($key)) {
                $bonus -= 0.15; // 15% Nerf
            }
        }

        // Limit to 200% multiplyer
        if($bonus > 2) {
            $bonus = 0;
        }

        // Limit to 50% nerf
        if($bonus < 0.5) {
            $bonus = 0;
        }

        return $bonus;
    }

}
