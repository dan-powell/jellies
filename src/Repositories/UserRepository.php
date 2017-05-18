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


    public function adjustTypes($types, $subtract = true, $user = null)
    {



        // If a user is not given, assume that the current one is required
        if(!$user) {
            $user = $this->current();
        }



        // Get an array of the user's existing types & quantities
        $user_types = $user->types->pluck('pivot.quantity', 'id');

        foreach($types as $type_id => $quantity) {

            if ($quantity < 0) {
                return false;
            }

            if(isset($user_types[$type_id])) {

                if($subtract) {
                    $user_types[$type_id] -= $quantity;
                } else {
                    $user_types[$type_id] += $quantity;
                }

            } else {
                $user_types[$type_id] = $quantity;
            }

            if ($user_types[$type_id] < 0) {
                $user_types[$type_id] = 0;
            }

        }

        $filtered = $user_types->reject(function ($value, $key) {
            return $value <= 0;
        });

        $array = [];
        foreach($filtered as $type_id => $quantity) {
            $array[$type_id] = ['quantity' => $quantity];
        }

        $user->types()->sync($array);

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
