<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Attack;

use DanPowell\Jellies\Repositories\UserRepository;
use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Game\DefenceRepository;
use DanPowell\Jellies\Repositories\Logic\UserBattleLogicInterface;

class AttackRepository extends AbstractModelRepository
{

    protected $userRepo;
    protected $defenceRepo;

    public function __construct(
        MinionRepository $minionRepo,
        UserRepository $userRepo,
        DefenceRepository $defenceRepo,
        UserBattleLogicInterface $battleLogic
        )
    {
        $this->model = new Attack();
        $this->battleLogic = $battleLogic;
        $this->userRepo = $userRepo;
        $this->defenceRepo = $defenceRepo;
        $this->minionRepo = $minionRepo;
    }

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->attacks();
    }

    public function store($user_id, $minion_id)
    {

        $target_user = $this->userRepo->query()->with('minions')->find($user_id);

        $minion_attacker = $this->minionRepo->query()->find($minion_id);
        $minion_defender = $target_user->minions->random();

        if($this->userRepo->spendAction()) {

            $battle = $this->battleLogic->engage($minion_attacker, $minion_defender);

            if(!$minion_attacker->isAlive()) {
                $this->userRepo->adjustTypes($minion_attacker->types->pluck('pivot.quantity', 'id'), false, $target_user);
            }


            if(!$minion_defender->isAlive()) {
                $this->userRepo->adjustTypes($minion_defender->types->pluck('pivot.quantity', 'id'), false);
            }




            $attack = $this->model;

            $attack->minion = '$minion';
            $attack->log = $battle['log'];
            $attack->successful = $battle['successful'];
            $attack->defender_id = $target_user->id;

            $this->userRepo->current()->attacks()->save($attack);


            $defence = $this->defenceRepo->model;

            $defence->minion = '$minion';
            $defence->log = $battle['log'];
            $defence->successful = $battle['successful'] ? false : true;
            $defence->attacker_id = $this->userRepo->current()->id;

            $target_user->defences()->save($defence);



            return $attack;
        } else {
            return false;
        }

    }
}
