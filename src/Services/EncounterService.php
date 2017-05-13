<?php

namespace DanPowell\Jellies\Services;

class EncounterService
{

    private $encounters;

    public function __construct()
    {
        $this->encounters = [];

        foreach(config('jellies.encounter.types') as $key => $type) {
            $this->encounters[$key] = app()->make($type['implementation']);
        }
    }

    public function getRandomEncounter() {

        $table = [];

        foreach($this->encounters as $key => $encounter) {

            $config = config('jellies.encounter.types.' . $key);

            for($i = 0; $i < $config['probability'] * 10; $i++) {
                $table[] = $key;
            }

        }

        $table_key = array_rand($table);

        return $this->encounters[$table[$table_key]];
    }

    public function getEncounter($key) {
        return $this->encounters[$key];
    }

}
