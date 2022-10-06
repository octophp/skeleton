<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

return [

    Doctrine\ORM\EntityManager::class => DI\factory([EntityManager::class, 'create'])
        ->parameter('connection', DI\get('doctrine.connection'))
        ->parameter('config', DI\get('doctrine.config')),

        'doctrine.connection' => [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../data/db.sqlite',
        ],

    'doctrine.config' =>
    ORMSetup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../src/Entities"), true, null, null, false),
];
