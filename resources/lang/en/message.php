<?php

return [

    'title' => 'Messages',
    'plural' => 'message|messages',

    'attribute' => [
        'subject' => 'Subject',
        'message' => 'Message',
    ],

    'index' => [
        'action' => 'View Messages',
        'title' => 'Your Messages',
        'tooltip' => 'View all of your messages',
        'help' => 'Messages from the system, informing you various occurences. Old messages are deleted after a certain time.',
        'empty' => 'You have no messages',
    ],

    'indexdeleted' => [
        'action' => 'View Old Messages',
        'title' => 'Your Old Messages',
        'tooltip' => 'View read messages',
        'help' => 'Messages that you have previously deleted',
        'empty' => 'You have no old messages.',
    ],

    'show' => [
        'action' => 'View Message',
        'title' => 'Message Details',
        'tooltip' => 'View the details of a specific message',
        'help' => 'This is a message. You may delete or archive it for later.',
    ],

];
