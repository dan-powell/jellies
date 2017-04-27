<?php

namespace DanPowell\Jellies\Helpers;

class EncounterCombat
{

    private $minions;
    private $enemies;
    private $creatures;

    private $log;

    private $victory = false;
    private $enemy_damage = 0;
    private $minion_damage = 0;
    private $rounds = 0;
    private $points = 0;

    public function __construct($minions, $enemies)
    {
        $this->minions = $minions;
        $this->enemies = $enemies;
        $this->creatures = $this->minions->merge($this->enemies);

        $this->log = collect([]);
    }

    public function engage() {

        $this->resolveCombatRound();

        return [
            'log' => $this->log,
            'victory' => $this->victory,
            'minion_damage' => $this->minion_damage,
            'enemy_damage' => $this->enemy_damage,
            'rounds' => $this->rounds,
            'points' => $this->points,
        ];
    }

    // Resolve a single round of combat
    private function resolveCombatRound()
    {
        // Setup
        $this->rounds++;

        $this->log('Round ' . $this->rounds);

        // Resolve combat in initiative order
        foreach($this->creatures->sortByDesc('initiative') as $creature) {

            if($creature->hp > 0) {

                // Pick Target
                $target = $this->getTarget($creature);

                // Fight
                $this->fight($creature, $target);

                // Check if a creature died, and act accordingly
                $this->deathCheck([$creature, $target]);

            }

        }

        // If there are creatures still alive, go for another round
        if($this->minions->sum('hp') > 0 && $this->enemies->sum('hp') > 0) {
            $this->resolveCombatRound();
        } else {

            // Otherwise do a bit of housekeeping
            $this->collectPoints();

            // Set victory to true if some minions are still alive
            if($this->minions->sum('hp')) {
                $this->victory = true;
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
        // Resolve attack
        $damage = $this->attack($attacker, $defender);

        // Make a record of the damage;
        $this->saveDamage($damage, $attacker);

        // Add a 50% chance for retaliation
        if(rand(0,1)) {
            // Resolve retaliation
            $damage = $this->counter($attacker, $defender);

            // Make a record of the damage;
            $this->saveDamage($damage, $defender);
        }
    }

    private function attack($attacker, $defender)
    {
        // Resolve attack
        $damage = $attacker->attack / $defender->defence;
        $defender->hp = $defender->hp - $damage;

        // Save to log
        $this->log(
            trans('encounter.log.attack',
                [
                    'attacker' => $attacker->name,
                    'defender' => $defender->name,
                    'damage' => $damage,
                ]
            )
        );

        return $damage;
    }

    private function counter($attacker, $defender)
    {
        // Resolve retaliation
        $damage = $defender->attack / $attacker->defence;
        $attacker->hp = $attacker->hp - $damage;

        // Save to log
        $this->log(
            trans('encounter.log.counter',
                [
                    'attacker' => $defender->name,
                    'defender' => $attacker->name,
                    'damage' => $damage,
                ]
            )
        );

        return $damage;
    }

    private function deathCheck($creatures) {
        foreach($creatures as $creature) {
            if($creature->hp <= 0) {
                // Save to log
                $this->log(trans('encounter.log.death',['creature' => $creature->name,]));
            }
        }
    }

    private function collectPoints() {
        foreach($this->creatures as $creature) {
            if ($creature->hp <= 0) {
                $this->points += $creature->points;
            }
        }
    }

    private function log($message) {
        if(config('jellies.encounter.logging')) {
            $this->log->push($message);
        }
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
