<?php

return [

    'title' => 'Zones',
    'plural' => 'zone|zones',

    'attribute' => [
        'name' => 'Name',
        'encounters' => 'Encounters',
    ],

    'index' => [
        'action' => 'View Zones',
        'title' => 'Zones',
        'tooltip' => 'Zones within a particular realm',
        'help' => 'Zones are areas within a realm. Incursions fight through each zone in order.',
        'empty' => 'There are currently no zones',
    ],

    'show' => [
        'action' => 'View Zone',
        'title' => 'Zone Details',
        'tooltip' => 'Zone Details',
        'help' => 'Each zone has a varierty of different enemies that may be encountered.',
    ],

];
