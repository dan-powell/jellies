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


    public function subtractPoints($points)
    {
        if($this->current()->points >= $points) {
            auth()->user()->points -= $points;
            auth()->user()->save();
        } else {
            abort(403, 'Not enough points');
        }
    }


    public function addPoints($points)
    {
        auth()->user()->points += $points;
        auth()->user()->save();
    }




}
