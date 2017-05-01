<?php

return [

    'title' => 'Incursions',
    'plural' => 'incursion|incursions',

    'attribute' => [
        'created_at' => 'Started',
        'encounters' => 'Encounters',
        'points' => 'Points',
    ],

    'index' => [
        'action' => 'View Incursions',
        'title' => 'Your Active Incursions',
        'tooltip' => 'Your Active Incursions',
        'help' => 'An incursion is a raid on another world. Send your minions in to battle via an incursion.',
        'empty' => 'You have no active incursions, send some minions in to battle!',
    ],

    'indexdeleted' => [
        'action' => 'View Previous Incursions',
        'title' => 'Your Previous Incursions',
        'tooltip' => '',
        'help' => '',
        'empty' => 'You have no previous incursions.',
    ],

    'show' => [
        'action' => 'View Incursion',
        'title' => 'Incursion Details',
        'tooltip' => 'Incursion Details',
        'help' => 'An incursion continues automatically until all minions are dead. Minions will encounter enemies over time. You may view the details of previous encounters here.',
        'active' => 'This incursion is currently happening',
        'inactive' => 'This incursion is now complete',
        'empty' => 'No encounters yet',
        'log' => 'Encounter Log',
    ],

    'create' => [
        'action' => 'Create Incursion',
        'title' => 'Create Incursion',
        'tooltip' => 'Create a new incursion',
        'help' => 'Choose minions to send on an incursion. Minions will then progress through various encounters until they are dead.',
        'danger' => 'Incursions cost ' . config('jellies.incursion.cost') . ' ' . trans_choice('jellies::game.point.plural', config('jellies.incursion.cost')),
        'choose' => 'Choose your minions',
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

    'remaining' => 'remaining',
    'completed' => 'complete',
    'gathered' => 'gathered',

];
