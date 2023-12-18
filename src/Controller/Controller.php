<?php

namespace Mafio\Slim\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class Controller
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    protected function render(Response $response, $template, $data = [])
    {
        $html = $this->ci->get('templating')->render($template, $data);
        $response->getBody()->write($html);
        return $response;
    }
}
