<?php

return [

    'title' => 'Incursions',
    'plural' => 'incursion|incursions',

    'attribute' => [
        'created_at' => 'Started',
        'encounters' => 'Encounters',
        'points' => 'Points',
    ],

    'labels' => [
        'active' => 'Incursions currently underway',
        'defeated' => 'Defeated Incursions',
        'waiting' => 'Incursions waiting to proceed'
    ],

    'index' => [
        'action' => 'View Incursions',
        'title' => 'Your Incursions',
        'tooltip' => 'Your Incursions',
        'help' => 'An incursion is a raid on another world. Send your minions in to battle via an incursion. An incursion continues automatically until all minions are dead.',
        'empty' => 'You have none',
    ],

    'show' => [
        'action' => 'View Incursion',
        'title' => 'Incursion Details',
        'tooltip' => 'Incursion Details',
        'help' => '',
        'messages' => [
            'active' => 'This incursion is currently happening. Minions will encounter enemies over time, come back later to check on their progress.',
            'waiting' => 'This incursion is waiting to proceed. Choose to cash-in any points accrued, or proceed to the next zone and risk it all.',
            'defeated' => 'Your minions have been defeated!',
            'inactive' => 'This incursion is now inactive',
        ],
        'empty' => 'No encounters yet',
        'log' => 'Encounter Log',
        'boxes' => [
            'zone' => [
                'title' => 'Zones',
                'current' => 'Current Zone',
                'encounters' => 'Encounters Completed',
                'defeated' => 'Defeated Zones',
            ],
            'minions' => [
                'title' => 'Minions',
                'remaining' => 'Minion Remaining|Minions Remaining',
                'rounds' => 'Combat Round|Combat Rounds'
            ],
            'points' => [
                'title' => 'Points',
                'gathered' => 'Point Gathered|Points Gathered'
            ],
        ],
        'actions' => [
            'proceed' => 'Proceed to the next zone',
            'finish' => 'Finish and cash-in points',
            'delete' => 'Finish the incursion',
            'process' => 'Force an encounter (Cheat)'
        ]
    ],

    'create' => [
        'action' => 'Create Incursion',
        'title' => 'Create Incursion',
        'tooltip' => 'Create a new incursion',
        'help' => 'Choose minions to send on an incursion. Minions will then progress through various encounters until they are dead.',
        'setup' => 'Setup your incursion',
        'minions' => 'Choose minions to send',
        'realm' => 'Choose a realm to invade',
        'success' => 'Incursion successfully created',
        'error' => 'Incursion failed. Do you have enough points?',
    ],

    'edit' => [
        'action' => 'Edit Incursion',
        'title' => 'Editing Incursion',
        'tooltip' => '',
        'help' => '',
    ],

    'update' => [
        'action' => 'Edit Incursion',
        'title' => 'Edit Incursion',
        'tooltip' => '',
        'help' => '',
        'success' => 'Incursion successfully updated',
        'error' => 'Incursion update failed. Do you have enough points?',
    ],

    'delete' => [
        'action' => 'Cash-in points',
        'title' => 'Cash-in points',
        'tooltip' => '',
        'help' => '',
    ],


];
