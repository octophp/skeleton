<?php

return function (Octophp\Encore\Application $app, DI\Container$container): void {
    $app->router->map('GET', '/', 'App\Controllers\IndexController::index');

    $app->router->map('GET', '/books/{id}/show', 'App\Controllers\IndexController::show');
    $app->router->map('POST', '/login', 'App\Controllers\LoginController::login');
    $app->router->map('GET', '/refresh', 'App\Controllers\RefreshTokenController::handleRefreshToken');
    $app->router->map('GET', '/top-secret', 'App\Controllers\IndexController::top_secret')
        ->middlewares(
            [
                $container->get('Octophp\Encore\Middlewares\AuthMiddleware'),
                $container->get('Octophp\Encore\Middlewares\AuthPayloadMiddleware'),
            ]);

    $app->router->map('GET', '/books', 'App\Controllers\IndexController::books')->middlewares(
        [
            $container->get('Octophp\Encore\Middlewares\AuthMiddleware'),
            $container->get('Octophp\Encore\Middlewares\AuthPayloadMiddleware'),
        ]);

};
