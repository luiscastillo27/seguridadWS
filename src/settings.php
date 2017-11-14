<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        
        // Configuración de mi APP ApiRestZeus
        'app_token_name'   => 'APP-TOKEN',
        'connectionString' => [
            'dns'  => 'mysql:host=localhost;dbname=zeus;charset=utf8',
            'user' => 'root',
            'pass' => 'admin'
        ]
    ],
];
