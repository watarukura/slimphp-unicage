<?php

use App\Controller\Base;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->map(
    ['POST', 'GET'],
    '/api/{service}/{function}',
    function ($request, $response, $args) use ($app) {
        $container = $app->getContainer();
        /** @var Slim\Container $container */
        return handle_request($request, $response, $args, $container);
    }
);

/**
 * @param Request         $request
 * @param Response        $response
 * @param array           $args
 * @param \Slim\Container $container
 *
 * @return Response
 */
function handle_request(Request $request, Response $response, array $args, Slim\Container $container)
{
    $service = ucfirst(strtolower($args['service']));
    $function = $args['function'];

    $class_name = sprintf('\App\Controller\%s\%s', $service, $function);

    /** @var Base $controller */
    $controller = new $class_name($container);
    $response = $controller->execute($request, $response, $args);
    return $response;
}
