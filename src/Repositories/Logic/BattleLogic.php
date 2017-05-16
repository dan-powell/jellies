<?php

namespace DanPowell\Jellies\Repositories\Logic;

use DanPowell\Jellies\Repositories\Logic\BattleLogicInterface;

class BattleLogic implements BattleLogicInterface
{

    private $attacker;
    private $defender;

    private $successful = false;
    private $rounds = 0;
    private $log;

    public function __construct()
    {
        $this->log = collect([]);
    }

    public function engage($attacker, $defender) {

        $this->attacker = $attacker;
        $this->defender = $defender;

        $this->resolveCombatRound();

        return [
            'log' => $this->log,
            'successful' => $this->successful,
        ];
    }

    // Resolve a single round of combat
    private function resolveCombatRound()
    {
        // Setup
        $this->rounds++;

        $this->log('Round ' . $this->rounds);

        // Resolve combat in initiative order
        if ($this->attacker->getStat('initiative') >= $this->defender->getStat('initiative')) {
            $this->fight($this->attacker, $this->defender);
            $this->fight($this->defender, $this->attacker);
        } else {
            $this->fight($this->defender, $this->attacker);
            $this->fight($this->attacker, $this->defender);
        }

        // If there are creatures still alive, go for another round
        if($this->attacker->health > 0 || $this->defender->health > 0) {
            $this->resolveCombatRound();
        } else {
            if ($this->attacker->health > 0) {
                $this->successful = true;
            }
        }
    }

    private function fight($attacker, $defender)
    {
        // Resolve attack
        $damage = $this->attack($attacker, $defender);

        // Make a record of the damage;


        // Add a 50% chance for retaliation
        if(rand(0,1)) {
            // Resolve retaliation
            $damage = $this->counter($attacker, $defender);

        }
    }


    private function attack($attacker, $defender)
    {
        // Resolve attack
        $damage = $attacker->getStat('attack') / $defender->getStat('defence');

        $defender->adjustHealth($damage);

        // Save to log
        $this->log(
            trans('jellies::encounter.log.attack',
            [
                'attacker' => $attacker->name,
                'defender' => $defender->name,
                'damage' => $damage,
            ]
            )
        );

    }

    private function counter($attacker, $defender)
    {
        // Resolve retaliation
        $damage = $defender->getStat('attack') / $attacker->getStat('defence');

        // Subtract health (make sure it doesn't go below 0)
        $defender->adjustHealth($damage);

        // Save to log
        $this->log(
            trans('jellies::encounter.log.counter',
            [
                'attacker' => $defender->name,
                'defender' => $attacker->name,
                'damage' => $damage,
            ]
            )
        );

    }

    private function log($message) {
        //if(config('jellies.encounter.logging')) {
            $this->log->push($message);
        //}
    }

}
