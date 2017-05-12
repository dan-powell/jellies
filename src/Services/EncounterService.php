<?php

namespace DanPowell\Jellies\Services;

class EncounterService
{

    private $encounters;

    public function __construct()
    {
        $this->encounters = [];

        foreach(config('jellies.encounter.types') as $type) {
            $this->encounters[] = app()->make($type['implementation']);
        }

    }

    public function getRandomEncounter() {
        $encounter_key = array_rand($this->encounters);
        return $this->encounters[$encounter_key];
    }


}
