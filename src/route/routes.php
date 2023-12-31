<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;

return function (App $app) {
    $app->get('/', function (RequestInterface $request, ResponseInterface $response, array $args) {
        $response->getBody()->write('Hello from Slim 4 request handler');
        return $response;
    });

    $app->map(['GET', 'POST'], '/books', function ($request, $response, array $args) {
        $response->getBody()->write(sprintf("Hello, %s!", 'mafio'));

        return $response;
    });

    $app->get('/hello/{name}', function (RequestInterface $request, ResponseInterface $response, array $args) {
        $response->getBody()->write('Hello from Slim 4 request handler ' . $args['name']);

        return $response;
    });
};
