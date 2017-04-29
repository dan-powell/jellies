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
        'tooltip' => '',
        'help' => '',
        'message' => [
            'none' => 'You have no active incursions',
        ],
    ],

    'indexdeleted' => [
        'action' => 'View Previous Incursions',
        'title' => 'Your Previous Incursions',
        'tooltip' => '',
        'help' => '',
        'none' => 'You have no previous incursions.',
    ],

    'show' => [
        'action' => 'View Incursion',
        'title' => 'Incursion Details',
        'tooltip' => '',
        'help' => '',
        'active' => 'This incursion is currently happening',
    ],

    'create' => [
        'action' => 'Create Incursion',
        'title' => 'Create Incursion',
        'tooltip' => '',
        'help' => '',
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
