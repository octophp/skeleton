<?php
declare (strict_types = 1);
$start_at = microtime(true);
error_reporting(E_ALL);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}
chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$container = require 'config/container.php';
$app = new \Octophp\Encore\Application($container, $start_at);
$app->router();
(require 'config/routes.php')($app, $container);
(require 'config/middlewares.php')($app, $container);

$app->run();
