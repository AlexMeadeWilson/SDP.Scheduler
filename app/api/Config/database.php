<?php

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        // Database Connection Details
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'testing',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];