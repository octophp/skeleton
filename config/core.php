<?php
use App\Middlewares\AuthMiddleware;
use App\Middlewares\CorsMiddleware;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Neomerx\Cors\Strategies\Settings;


return [
    'App\Middlewares\AuthMiddleware' => function (ContainerInterface $c) {
        return new AuthMiddleware($c->get('JWT_SECRET'), $c->get('JWT_TOKEN_KEY'));
    },

    'App\Middlewares\CorsMiddleware' => function (ContainerInterface $c) {

        $settings = (new Settings())
                ->setServerOrigin('http', 'localhost', 8000)
                ->setPreFlightCacheMaxAge(0)
                ->setCredentialsSupported(true)
                ->setAllowedOrigins(['http://localhost:8000', 'http://localhost:3000']) // or enableAllOriginsAllowed()
                ->setAllowedMethods(['POST', 'GET', 'DELETE', 'OPTIONS'])   // or enableAllMethodsAllowed()
                ->setAllowedHeaders(['Authorization', 'Content-Type', 'x-xsrf-token', 'x_csrftoken', 'X-Requested-With', 'Cache-Control'])         // or enableAllHeadersAllowed()
                ->setExposedHeaders(['X-Custom-Header'])
                ->disableAddAllowedMethodsToPreFlightResponse()
                ->disableAddAllowedHeadersToPreFlightResponse()
                ->enableAllOriginsAllowed()
                ->enableAllMethodsAllowed()
                ->enableCheckHost();

        return new CorsMiddleware($settings, $c->get(Psr\Log\LoggerInterface::class));
    },    

 

    Psr\Log\LoggerInterface::class => DI\factory(function () {
        $logger = new Logger('application-logs');

        $fileHandler = new StreamHandler('var/app.log', Logger::DEBUG);
        $fileHandler->setFormatter(new LineFormatter());
        $logger->pushHandler($fileHandler);

        return $logger;
    }),
];