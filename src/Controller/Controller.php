<?php

namespace Mafio\Slim\Controller;

use Mafio\Slim\Exceptions\MafioException;
use Monolog\Logger;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class Controller
{
    protected ContainerInterface $container;
    protected Logger $logger;

    public function __construct(ContainerInterface $ci, Logger $logger)
    {
        $this->container = $ci;
        $this->logger = $logger;
    }

    public function render(Response $response, $template, $data = []): Response
    {
        $html = '';
        try {
            $html = $this->container->get('templating')->render($template, $data);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            $this->logger->critical($e->getMessage(), ["exception" => $e]);

            throw new MafioException($e);
        }
        $response->getBody()->write($html);

        return $response;
    }
}
