<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

//$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
//    // Sample log message
//    $this->logger->info("Slim-Skeleton '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});

$app->map(['GET', 'POST'], '/hello', function (Request $request, Response $response) {
    $getParams = $request->getQueryParams() ?? [];
    $postPutParams = $request->getParsedBody() ?? [];
    $allParams = array_merge($getParams, $postPutParams);

    $body = "ReceivedParam =" . json_encode($allParams);
    return $response->getBody()->write($body);
});
