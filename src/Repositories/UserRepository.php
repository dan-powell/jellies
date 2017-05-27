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


    public function getMaterials()
    {
        return $this->current()->materials()->get();
    }


    public function adjustMaterials($materials, $subtract = true, $user = null)
    {

        // If a user is not given, assume that the current one is required
        if(!$user) {
            $user = $this->current();
        }



        // Get an array of the user's existing materials & quantities
        $user_materials = $user->materials->pluck('pivot.quantity', 'id');

        foreach($materials as $material_id => $quantity) {

            if ($quantity < 0) {
                return false;
            }

            if(isset($user_materials[$material_id])) {

                if($subtract) {
                    $user_materials[$material_id] -= $quantity;
                } else {
                    $user_materials[$material_id] += $quantity;
                }

            } else {
                $user_materials[$material_id] = $quantity;
            }

            if ($user_materials[$material_id] < 0) {
                $user_materials[$material_id] = 0;
            }

        }

        $filtered = $user_materials->reject(function ($value, $key) {
            return $value <= 0;
        });

        $array = [];
        foreach($filtered as $material_id => $quantity) {
            $array[$material_id] = ['quantity' => $quantity];
        }

        $user->materials()->sync($array);

        return true;

    }


    public function spendAction($points = 1, $user = null)
    {

        if(!$user) {
            $user = $this->current();
        }

        if($user->actions > 0) {
            $user->actions -= $points;
            $user->save();
            return true;
        } else {
            return false;
        }

    }


    public function addAction($user = null)
    {
        if(!$user) {
            $user = $this->current();
        }

        if($user->actions < config('jellies.user.actions_max') ) {
            $user->actions += 1;
            $user->save();
        }

    }




}
