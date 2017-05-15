<?php

namespace DanPowell\Jellies\Repositories;

use DanPowell\Jellies\Repositories\AbstractModelRepository;

use DanPowell\Jellies\Models\User;

// TODO improve this repos so that it becomes the home for all methods related to users

class UserRepository extends AbstractModelRepository
{

    public function __construct()
    {
        $this->model = new User();
    }

    // Get the currently
    public function current()
    {
        if(auth()->check()) {
            return auth()->user();
        } else {
            return null;
        }

    }


    public function getTypes()
    {
        return $this->current()->types()->get();
    }

    public function getWithMinions()
    {
        return $this->query()->with('minions')->get();
    }




    public function adjustTypes($types, $subtract = true)
    {

        $user_types = $this->getTypes();

        $stuff = [];
        foreach($user_types as $user_type) {

            if($subtract) {
                $quantity = $user_type->pivot->quantity - $types[$user_type->id];
            } else {
                $quantity = $user_type->pivot->quantity + $types[$user_type->id];
            }

            if ($quantity < 0) {
                return false;
            }

            $stuff[$user_type->id] = ['quantity' => $quantity];

        }

        $this->current()->types()->sync($stuff);

        return true;

    }


    public function spendAction($points = 1)
    {

        if($this->current()->actions > 0) {
            $this->current()->actions -= $points;
            $this->current()->save();
            return true;
        } else {
            return false;
        }


    }


}
