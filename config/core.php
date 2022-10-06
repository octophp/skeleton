<?php
use App\Middlewares\AuthMiddleware;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

return [
    'App\Middlewares\AuthMiddleware' => function (ContainerInterface $c) {
        return new AuthMiddleware($c->get('JWT_SECRET'), $c->get('JWT_TOKEN_KEY'));
    },

    Psr\Log\LoggerInterface::class => DI\factory(function () {
        $logger = new Logger('application-logs');

        $fileHandler = new StreamHandler('var/app.log', Logger::DEBUG);
        $fileHandler->setFormatter(new LineFormatter());
        $logger->pushHandler($fileHandler);

        return $logger;
    }),
];