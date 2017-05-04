<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Models\Game\Minion;

class MinionRepository extends AbstractModelRepository
{

    protected $userRepo;
    protected $miniontypeRepo;

    public function __construct(UserRepository $userRepo, MiniontypeRepository $miniontypeRepo)
    {
        $this->model = new Minion();
        $this->userRepo = $userRepo;
        $this->miniontypeRepo = $miniontypeRepo;
    }

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->minions();
    }

    public function store($id)
    {

        $type = $this->miniontypeRepo->query()->findOrFail($id);

        // Check if the user has enough points
        if(auth()->user()->points >= $type->cost) {

            $this->userRepo->subtractPoints($type->cost);

            return factory(\DanPowell\Jellies\Models\Game\Minion::class)->create([
                'user_id' => auth()->user()->id,
                'miniontype_id' => $id,
                'attack' => $type->attack,
                'defence' => $type->defence,
                'initiative' => $type->initiative,
                'health' => $type->health,
            ]);
        } else {
            return false;
        }

    }

    public function update($id, $input)
    {

        $minion = $this->query()->findOrFail($id);

        // Update Name
        if(isset($input['name'])) {
            $minion->name = $input['name'];
        }

        // Update Stats
        $cost = 0;

        if(isset($input['attack'])) {
            $cost += $input['attack'];
        }

        if(isset($input['defence'])) {
            $cost += $input['defence'];
        }

        if(isset($input['initiative'])) {
            $cost += $input['initiative'];
        }

        if(isset($input['health'])) {
            $cost += $input['health'];
        }

        if($cost == 0) {
            $minion->save();
            return $minion;
        }

        if(auth()->user()->points >= $cost) {

            $this->userRepo->subtractPoints($cost);

            if(isset($input['attack'])) {
                $minion->attack += $input['attack'];
            }

            if(isset($input['defence'])) {
                $minion->defence += $input['defence'];
            }

            if(isset($input['initiative'])) {
                $minion->initiative += $input['initiative'];
            }

            if(isset($input['health'])) {
                $minion->health += $input['health'];
            }

            $minion->save();

            return $minion;

        } else {
            return false;
        }

    }

    public function heal($id)
    {

        $minion = $this->query()->withTrashed()->findOrFail($id);

        $cost = $minion->health - $minion->hp;

        // Check if the user has enough points
        if(auth()->user()->points >= $cost) {

            $this->userRepo->subtractPoints($cost);

            $minion->hp = $minion->health;
            $minion->deleted_at = null;

            $minion->save();

            return true;
        } else {
            return false;
        }

    }


}
