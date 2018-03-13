<?php declare(strict_types=1);

namespace Qlimix\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\Log\Logger\Request\RequestLoggerInterface;

final class RequestLoggerMiddleware implements MiddlewareInterface
{
    /** @var RequestLoggerInterface */
    private $requestLogger;

    /**
     * @param RequestLoggerInterface $requestLogger
     */
    public function __construct(RequestLoggerInterface $requestLogger)
    {
        $this->requestLogger = $requestLogger;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->requestLogger->log($request);

        return $handler->handle($request);
    }
}
