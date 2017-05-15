<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\Game\Attack;

use DanPowell\Jellies\Repositories\UserRepository;
use DanPowell\Jellies\Repositories\Game\MinionRepository;
use DanPowell\Jellies\Repositories\Game\DefenceRepository;
use DanPowell\Jellies\Repositories\Logic\BattleLogicInterface;

class AttackRepository extends AbstractModelRepository
{

    protected $userRepo;
    protected $defenceRepo;

    public function __construct(
        MinionRepository $minionRepo,
        UserRepository $userRepo,
        DefenceRepository $defenceRepo,
        BattleLogicInterface $battleLogic
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

        $user = $this->userRepo->query()->with('minions')->find($user_id);

        $minion = $this->minionRepo->query()->find($minion_id);

        if($this->userRepo->spendAction()) {

            $battle = $this->battleLogic->engage($minion, $user->minions->random());

            $attack = $this->model;

            $attack->minion = $minion->toJson();
            $attack->successful = $battle;
            $attack->defender_id = $user->id;

            $this->userRepo->current()->attacks()->save($attack);


            $defence = $this->defenceRepo->model;

            $defence->minion = $minion->toJson();
            $defence->successful = $battle ? false : true;
            $defence->attacker_id = $this->userRepo->current()->id;

            $user->defences()->save($defence);



            return $attack;
        } else {
            return false;
        }

    }
}
