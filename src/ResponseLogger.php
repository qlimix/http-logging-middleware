<?php declare(strict_types=1);

namespace Qlimix\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\Log\Logger\Response\ResponseLoggerInterface;

final class ResponseLogger implements MiddlewareInterface
{
    /** @var ResponseLoggerInterface */
    private $responseLogger;

    /**
     * @param ResponseLoggerInterface $responseLogger
     */
    public function __construct(ResponseLoggerInterface $responseLogger)
    {
        $this->responseLogger = $responseLogger;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        $this->responseLogger->log($response);

        return $response;
    }
}
