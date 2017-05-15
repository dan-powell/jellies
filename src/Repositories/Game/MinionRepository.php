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

    public function store($types)
    {

        if($this->userRepo->spendAction()) {

            if($this->userRepo->adjustTypes($types)) {

                $types_sorted = [];
                foreach($types as $key => $type) {
                    if($type) {
                        $types_sorted[$key] = ['quantity' => $type];
                    }
                }

                $minion = factory(\DanPowell\Jellies\Models\Game\Minion::class)->create([
                    'user_id' => auth()->user()->id,
                ]);

                $minion->types()->sync($types_sorted);

                return $minion;

            } else {
                return false;
            }
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
}
