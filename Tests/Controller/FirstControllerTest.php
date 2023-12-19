<?php

namespace Controller;

use Monolog\Logger;
use PHPUnit\Framework\MockObject\Exception;
use Psr\Http\Message\StreamInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use PHPUnit\Framework\TestCase;
use Mafio\Slim\Controller\FirstController;
use Mafio\Slim\Controller\Controller;

class FirstControllerTest extends TestCase
{
    private ContainerInterface $containerMock;
    private Logger $logger;
    private Response $response;
    private Controller $templating;
    private FirstController $firstController;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->containerMock = $this->createMock(ContainerInterface::class);
        $this->logger = $this->createMock(Logger::class);
        $this->response = $this->getMockBuilder(Response::class)
            ->enableOriginalClone()
            ->getMock();

        $this->templating = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([$this->containerMock, $this->logger])
            ->onlyMethods(['render'])
            ->getMock();

        $this->templating->method('render')->willReturn($this->response);
        $this->response->method('getBody')
            ->willReturn($this->createMock(StreamInterface::class));
        $this->containerMock->method('get')->willReturn($this->templating);
        $this->firstController = new FirstController($this->containerMock);
    }

    public function testHomepage()
    {
        try {
            $response = $this->firstController->homepage($this->response);
            $this->assertInstanceOf(Response::class, $response);
            $body = $response->getBody();
            $body->rewind();

            $this->assertEquals('homepage.html', $body->getContents());
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            $this->handleException($e);
        }
    }

    private function handleException($e): void
    {
        echo $e->getMessage()."  |||  ".$e->getTraceAsString();
        error_log($e->getMessage(), 3, '/var/logs/log.log');
    }
}
