<?php

return [

    'title' => 'Minions',
    'plural' => 'minion|minions',

    'attribute' => [
        'name' => 'Name',
        'stats' => 'Stats',
        'attack' => 'Attack',
        'defence' => 'Defence',
        'initiative' => 'Initiative',
        'health' => 'Health (max HP)',
        'hp' => 'HP',
        'level' => 'Level',
        'active' => 'Raiding',
    ],

    'index' => [
        'action' => 'View Minions',
        'title' => 'Your Minions',
        'tooltip' => 'Your minions',
        'help' => 'Minions are the troops of your army. Send them in to battle via an Incursion.',
        'empty' => 'You have no minions, your should create some.',
    ],

    'indexdeleted' => [
        'action' => 'View Dead Minions',
        'title' => 'Your Dead Minions',
        'tooltip' => 'Your Dead Minions',
        'help' => 'These are minions that have been killed. You may resurrect them.',
        'danger' => 'Resurrecting a minion costs ' . config('jellies.minion.cost_heal') . ' ' . trans_choice('jellies::game.point.plural', config('jellies.minion.cost_heal')),
        'empty' => 'You have no dead minions.',
    ],

    'show' => [
        'action' => 'View Minion',
        'title' => 'Minion Details',
        'tooltip' => 'Minion Details',
        'help' => 'Minions have health and basic stats. They can be healed and stats can be upgraded.',
        'active' => 'This minion is currently engaged in an incursion',
    ],

    'create' => [
        'action' => 'Create Minion',
        'title' => 'Create Minion',
        'tooltip' => 'Create Minion',
        'help' => 'Minions can be created to serve you.',
        'danger' => 'Creating a minion costs ' . config('jellies.minion.cost') . ' ' . trans_choice('jellies::game.point.plural', config('jellies.minion.cost')),
        'success' => 'Minion successfully summoned',
        'error' => 'Minion creation failed. Do you have enough points?',
    ],

    'edit' => [
        'action' => 'Edit Minion',
        'title' => 'Editing Minion',
        'tooltip' => 'Edit the name and stats of a minion',
        'help' => 'Minions can be renamed and thier stats can be upgraded.',
        'danger' => 'It costs ' . config('jellies.minion.cost_upgrade') . ' ' . trans_choice('jellies::game.point.plural', config('jellies.minion.cost_upgrade')) . ' to upgrade each stat point.',
    ],

    'update' => [
        'action' => 'Edit Minion',
        'title' => 'Edit Minion',
        'tooltip' => 'Save your Minion',
        'success' => 'Minion successfully updated',
        'error' => 'Minion update failed. Do you have enough points?',
    ],

    'delete' => [
        'action' => 'Kill Minion',
        'title' => 'Kill Minion',
        'tooltip' => 'Destroy your minion',
    ],

    'heal' => [
        'action' => 'Heal/Resurrect Minion',
        'title' => 'Heal/Resurrect Minion',
        'tooltip' => 'Heal/Resurrect Minion',
        'success' => 'Minion successfully healed',
        'error' => 'Minion healing failed. Do you have enough points?',
    ],

];
