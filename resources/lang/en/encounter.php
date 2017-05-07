<?php

return [

    'title' => 'Encounter',
    'plural' => 'encounter|encounters',

    'attribute' => [
        'minions' => 'Minions',
        'enemies' => 'Enemies',
        'victory' => 'Victory?',
        'rounds' => 'Rounds',
        'damage_minion' => 'Damage by Minions',
        'damage_enemy' => 'Damage by Enemies',
        'points' => 'Points gained',
        'log' => 'Battle log'
    ],

    'show' => [
        'action' => 'View Encounter Log',
        'title' => 'Encounter Details',
        'tooltip' => 'Encounter Details',
        'help' => '',
        'boxes' => [
            'zone' => [
                'title' => 'Zones',
                'current' => 'Current Zone',
                'encounters' => 'Encounters Completed',
                'defeated' => 'Defeated Zones',
            ],
        ],
    ],

    'log' => [
        'attack' => ':attacker attacked :defender for :damage damage.',
        'counter' => ':attacker retaliated for :damage damage.',
        'death' => ':creature was killed.'
    ],

    'rounds' => [
        'title' => 'Combat Round',
        'plural' => 'combat round|combat rounds',
    ]

];
