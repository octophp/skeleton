#!/usr/bin/env php
<?php
// bin/doctrine

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Adjust this path to your actual bootstrap.php
require __DIR__ . '/container.php';
$entityManager = $container->get(Doctrine\ORM\EntityManager::class); 

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);