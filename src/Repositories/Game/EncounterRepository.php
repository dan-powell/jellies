<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Encounter;

use DanPowell\Jellies\Repositories\Game\EnemyRepository;
use DanPowell\Jellies\Helpers\EncounterCombat;

use DanPowell\Jellies\Repositories\Logic\ZoneBattleLogicInterface;

class EncounterRepository extends AbstractModelRepository
{

    private $minionRepo;
    private $userRepo;
    private $enemyRepo;

    public function __construct(EnemyRepository $enemyRepo, ZoneBattleLogicInterface $battleLogic)
    {
        $this->model = new Encounter();

        $this->enemyRepo = $enemyRepo;
        $this->battleLogic = $battleLogic;
    }

    public function encounter($incursion)
    {
        // Setup
        $minions = $incursion->minions;

        $enemies = $this->enemyRepo->getRandomEnemies(rand(1,5), $incursion->zone->id);

        $this->model->minions_before = $minions;
        $this->model->enemies = $enemies;
        $this->model->zone_id = $incursion->zone->id;

        $details = $this->battleLogic->engage($minions, $enemies);

        $this->model->fill($details);

        $this->model->minions_after = $minions;

        $incursion->encounters()->save($this->model);

        // Update the minions
        $minions->each(function($minion) use ($incursion, $minions) {
            $minion->save();
            if(!$minion->alive) {
                $minion->incursions()->detach($incursion);
                $minion->delete();
            }
        });

        $this->postEncounterCheck($incursion, $minions);
    }

    private function postEncounterCheck($incursion, $minions)
    {
        if(count($incursion->encounters->where('zone_id', $incursion->zone->id)) >= $incursion->zone->size) {
            $incursion->previous_zones()->attach($incursion->zone);

            $incursion->zone_id = null;

            if (count($incursion->previous_zones) >= 10) {
                $incursion->complete = true;
            }

            $incursion->save();

            if(isset($incursion->user)) {
                app('message')
                    ->subject(trans('jellies::email.zone_complete.subject'))
                    ->message(trans('jellies::email.zone_complete.message'))
                    ->id($incursion->user->id)
                    ->type('success')
                    ->action_name(trans('jellies::email.zone_complete.action'))
                    ->action_url(route('incursion.show', $incursion->id))
                    ->send();
            }

        }

        /*
        if($false) {

            app('message')
                ->subject(trans('jellies::email.incursion_defeated.subject'))
                ->message(trans('jellies::email.incursion_defeated.message'))
                ->id($incursion->user->id)
                ->action_name(trans('jellies::email.incursion_defeated.action'))
                ->action_url(route('incursion.show', $incursion->id))
                ->send();
        }
        */

    }

}
