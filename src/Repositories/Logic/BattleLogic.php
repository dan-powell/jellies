<?php

namespace DanPowell\Jellies\Repositories\Logic;

use DanPowell\Jellies\Repositories\Logic\BattleLogicInterface;

use DanPowell\Jellies\Repositories\Logic\DamageLogicInterface;

class BattleLogic implements BattleLogicInterface
{
    private $minions;
    private $enemies;
    private $creatures;

    private $log;

    private $successful = false;
    private $enemy_damage = 0;
    private $minion_damage = 0;
    private $rounds = 0;
    private $points = 0;

    public function __construct(DamageLogicInterface $damageLogic)
    {
        $this->log = collect([]);
        $this->damageLogic = $damageLogic;
    }

    public function engage($minions, $enemies) {

        $this->minions = $minions;
        $this->enemies = $enemies;
        $this->creatures = $this->minions->merge($this->enemies);

        $this->resolveCombatRound();

        return [
            'log' => $this->log,
            'successful' => $this->successful,
            'minion_damage' => $this->minion_damage,
            'enemy_damage' => $this->enemy_damage,
            'rounds' => $this->rounds,
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
        foreach($this->creatures->sortBy(function($creature) {
            return $creature->getStat('initiative');
        }) as $creature) {

            \Debugbar::info('creature attacking. Alive? '. $creature->isAlive());

            if($creature->isAlive()) {

                // Pick Target
                $target = $this->getTarget($creature);

                // Fight
                $this->fight($creature, $target);

                // Check if a creature died, and act accordingly
                $this->deathCheck([$creature, $target]);

            }

        }

        $minions_alive = $this->minions->filter(function ($minion) {
            return $minion->isAlive();
        });

        \Debugbar::info($minions_alive);

        $enemies_alive = $this->enemies->filter(function ($enemy) {
            return $enemy->isAlive();
        });

        \Debugbar::info($enemies_alive);

        // If there are creatures on both sides still alive, go for another round
        if(count($minions_alive) && count($enemies_alive)) {
            $this->resolveCombatRound();
        } else {

            // Set victory to true if some minions are still alive
            if(count($this->minions->filter(function ($minion) {
                return $minion->isAlive();
            }))) {
                $this->successful = true;
            }

        }

    }

    private function getTarget($creature) {
        switch (get_class($creature)) {
            case 'DanPowell\Jellies\Models\Game\Minion':
                return $this->enemies->random();
                break;
            case 'DanPowell\Jellies\Models\Game\Enemy':
                return $this->minions->random();
                break;
            default:
                return null;
        }
    }

    private function fight($attacker, $defender)
    {
        \Debugbar::info($attacker->name . ' vs ' . $defender->name);

        // Resolve attack
        $damage = $this->damageLogic->damage($attacker, $defender);

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

    private function deathCheck($creatures) {
        foreach($creatures as $creature) {
            if(!$creature->isAlive()) {
                // Save to log
                $this->log(trans('jellies::encounter.log.death',['creature' => $creature->name,]));
            }
        }
    }

    private function log($message) {

            $this->log->push($message);

    }

    private function saveDamage($damage, $creature) {
        switch (get_class($creature)) {
            case 'DanPowell\Jellies\Models\Game\Minion':
                $this->minion_damage += $damage;
                break;
            case 'DanPowell\Jellies\Models\Game\Enemy':
                $this->enemy_damage += $damage;
                break;
        }
    }

}
