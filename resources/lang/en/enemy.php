<?php

return [

    'title' => 'Enemies',
    'plural' => 'enemy|enemies',

    'attribute' => [
        'name' => 'Name',
        'stats' => 'Stats',
        'attack' => 'Attack',
        'defence' => 'Defence',
        'initiative' => 'Initiative',
        'health' => 'Health (max HP)',
        'hp' => 'HP',
        'level' => 'Level',
    ],

    'index' => [
        'action' => 'View Enemies',
        'title' => 'Current Enemies',
        'tooltip' => '',
        'help' => 'Enemies are encountered during an incursion. Minions will fight enemies to the death. Defeating an enemy yields points.',
        'empty' => 'There are currently no enemies',
    ],

    'show' => [
        'action' => 'View Enemy',
        'title' => 'Enemy Details',
        'tooltip' => 'Enemy Details',
        'help' => 'Enemies have stats similiar to minions.',
    ],

];
