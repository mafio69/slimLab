<?php

namespace Mafio\Slim\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FirstController
{
    private $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function homepage(Request $request, Response $response)
    {
        $html = $this->ci->get('templating')->render('homepage.html');
        $response->getBody()->write($html);
        return $response;
    }
}
