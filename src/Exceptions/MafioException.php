<?php

namespace Mafio\Slim\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class MafioException extends Exception
{
    protected NotFoundExceptionInterface|Exception $exception;

    public function __construct(Exception|NotFoundExceptionInterface $e)
    {
        parent::__construct();
        $this->exception = $e;
    }
}