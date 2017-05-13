<?php

return [

    // Enables database logging of interactions
    'logging' => true,

    'types' => [
        'battle' => [
            'implementation' => DanPowell\Jellies\Repositories\Encounters\BattleEncounter::class,
            'probability' => 1
        ],
        'nothing' => [
            'implementation' => DanPowell\Jellies\Repositories\Encounters\NothingEncounter::class,
            'probability' => 1
        ]
    ]



];
