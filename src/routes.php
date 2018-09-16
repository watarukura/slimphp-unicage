<?php

use App\Controller\Base;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->map(
    ['POST', 'GET'],
    '/api/{service}/{function}',
    function ($request, $response, $args) use ($container) {
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
    $function = ucfirst(strtolower($args['function']));

    $class = sprintf('\App\Controller\%s\%s', $service, $function);
    if (!class_exists($class, true)) {
        $status = 404;
        $data = ['code' => $status];
        $response = $response->withJson($data, $status);
        return $response;
    }

    /** @var Base $controller */
    $controller = new $class($container);
    $response = $controller->execute($request, $response, $args);
    return $response;
}
