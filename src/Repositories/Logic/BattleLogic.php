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

        \Debugbar::info('engage attacker h: ' . $this->attacker->health);
        \Debugbar::info('engage defender h: ' . $this->defender->health);

        $this->resolveCombatRound();

        if ($this->attacker->isAlive() && !$this->defender->isAlive()) {
            $this->successful = true;
        }

        \Debugbar::info('complete attacker h: ' . $this->attacker->health);
        \Debugbar::info('complete defender h: ' . $this->defender->health);

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

        \Debugbar::info('start round: ' . $this->rounds);
        $this->log('Round ' . $this->rounds);

        // Resolve combat in initiative order
        if ($this->attacker->getStat('initiative') >= $this->defender->getStat('initiative')) {

            $this->fight($this->attacker, $this->defender);

            if($this->attacker->isAlive() && $this->defender->isAlive()) {
                $this->fight($this->defender, $this->attacker);
            }

        } else {
            $this->fight($this->defender, $this->attacker);

            if($this->attacker->isAlive() && $this->defender->isAlive()) {
                $this->fight($this->attacker, $this->defender);
            }

        }

        \Debugbar::info('round complete attacker h: ' . $this->attacker->health);
        \Debugbar::info('round complete defender h: ' . $this->defender->health);

        \Debugbar::info('attacker alive? ' . $this->attacker->isAlive());
        \Debugbar::info('defender alive? ' . $this->defender->isAlive());

        // If there are creatures still alive, go for another round
        if($this->rounds < 30) {
            if(($this->attacker->isAlive() && $this->defender->isAlive())) {
                $this->resolveCombatRound();
            }
        }

    }

    private function fight($attacker, $defender)
    {
        \Debugbar::info($attacker->name . ' vs ' . $defender->name);

        // Resolve attack
        $damage = $attacker->getStat('attack') / $defender->getStat('defence');

        \Debugbar::info('round damage: ' . $damage);

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

    private function log($message) {
        //if(config('jellies.encounter.logging')) {
            $this->log->push($message);
        //}
    }

}
