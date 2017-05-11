<?php

return [

    // Enables database logging of interactions
    'logging' => true,

    'types' => [
        [
            'implementation' => DanPowell\Jellies\Encounters\BattleEncounter::class,
            'probability' => 0.5
        ],
        [
            'implementation' => DanPowell\Jellies\Encounters\NothingEncounter::class,
            'probability' => 0.5
        ]
    ]



];
