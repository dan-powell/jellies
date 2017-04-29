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
        'tooltip' => '',
        'help' => '',
        'none' => 'You have no minions, summon or resurrect some more.',
    ],

    'indexdeleted' => [
        'action' => 'View Dead Minions',
        'title' => 'Your Dead Minions',
        'tooltip' => '',
        'help' => '',
        'none' => 'You have no dead minions.',
    ],

    'show' => [
        'action' => 'View Minion',
        'title' => 'Minion Details',
        'tooltip' => '',
        'help' => '',
        'active' => 'This minion is currently engaged in an incursion',
    ],

    'create' => [
        'action' => 'Summon Minion',
        'title' => 'Summon Minion',
        'tooltip' => '',
        'help' => '',
        'success' => 'Minion successfully summoned',
        'error' => 'Minion summoning failed. Do you have enough points?',
    ],

    'edit' => [
        'action' => 'Edit Minion',
        'title' => 'Editing Minion',
        'tooltip' => '',
        'help' => '',
    ],

    'update' => [
        'action' => 'Edit Minion',
        'title' => 'Edit Minion',
        'tooltip' => '',
        'help' => '',
        'success' => 'Minion successfully updated',
        'error' => 'Minion update failed. Do you have enough points?',
    ],

    'delete' => [
        'action' => 'Kill Minion',
        'title' => 'Kill Minion',
        'tooltip' => '',
        'help' => '',
    ],

    'heal' => [
        'action' => 'Heal/Resurrect Minion',
        'title' => 'Heal/Resurrect Minion',
        'tooltip' => '',
        'help' => '',
        'success' => 'Minion successfully healed',
        'error' => 'Minion healing failed. Do you have enough points?',
    ],

];
