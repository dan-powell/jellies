<?php

namespace DanPowell\Jellies\Repositories\Game;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Repositories\UserRepository;

use DanPowell\Jellies\Models\Game\Minion;

class MinionRepository extends AbstractModelRepository
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->model = new Minion();
        $this->userRepo = $userRepo;
    }

    // Get all if owned by user
    public function query()
    {
        return auth()->user()->minions();
    }

    public function store()
    {
        // Check if the user has enough points
        if(auth()->user()->points >= config('jellies.minion.cost')) {

            $this->userRepo->subtractPoints(config('jellies.minion.cost'));

            factory(\DanPowell\Jellies\Models\Game\Minion::class)->create([
                'user_id' => auth()->user()->id
            ]);
            return true;
        } else {
            return false;
        }

    }

    public function update($id, $input)
    {

        $minion = $this->query()->findOrFail($id);

        // Update Name
        if(isset($input['firstname'])) {
            $minion->firstname = $input['firstname'];
        }
        if(isset($input['nickname'])) {
            $minion->nickname = $input['nickname'];
        }
        if(isset($input['lastname'])) {
            $minion->lastname = $input['lastname'];
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
