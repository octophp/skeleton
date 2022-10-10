# Quickstart skeleton for Encore
PHP API skeleton project based on Encore

Clone the reporsitory to your computer or server

```
git clone https://github.com/octophp/skeleton.git
```


Run composer update to setup packages

```
composer update
```

Create your own environment file with your settings

.env
```
JWT_SECRET=topse%1cretK9Cc6ASmi
JWT_REFRESH_SECRET=topse%1cretK9Cc6ASmi
JWT_TOKEN_KEY=olLSfcifnzXRLzMqhq1aAGJ7YEn-K9Cc6ASmi-Vnsxb1HTbOcUK6MTplkrmnmH9mxl
```

The current version is using sqlite database, however you can easily move to any database supported by [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html)

doctrine.php

````
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
````

## React Frontend SPA project
You can use frontend [React based SPA site](https://github.com/octophp/frontend) to test the skeleton. 
