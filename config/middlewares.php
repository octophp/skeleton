<?php

return function (Octo\Encore\Application $app, DI\Container $container): void {
    $app->router->middlewares(
        [
            $container->get('Mezzio\Helper\BodyParams\BodyParamsMiddleware'),
        ]);
};
