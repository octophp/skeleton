<?php

return function (Octophp\Encore\Application $app, DI\Container $container): void {
    $app->router->middlewares(
        [
            $container->get('Mezzio\Helper\BodyParams\BodyParamsMiddleware'),
            $container->get('Octophp\Encore\Middlewares\CorsMiddleware'),
        ]);
};
