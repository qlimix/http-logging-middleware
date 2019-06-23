<?php declare(strict_types=1);

namespace Qlimix\Tests\HttpMiddleware;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\HttpMiddleware\RequestLoggerMiddleware;
use Qlimix\Log\Logger\Request\RequestLoggerInterface;

final class RequestLoggerMiddlewareTest extends TestCase
{
    /** @var MockObject */
    private $requestLogger;

    /** @var MockObject */
    private $request;

    /** @var MockObject */
    private $handler;

    /** @var RequestLoggerMiddleware */
    private $requestLoggerMiddleware;

    protected function setUp(): void
    {
        $this->requestLogger = $this->createMock(RequestLoggerInterface::class);
        $this->requestLoggerMiddleware = new RequestLoggerMiddleware($this->requestLogger);

        $this->request = $this->createMock(ServerRequestInterface::class);
        $this->handler = $this->createMock(RequestHandlerInterface::class);
    }

    /**
     * @test
     */
    public function shouldLog(): void
    {
        $this->requestLogger->expects($this->once())
            ->method('log');

        $this->handler->expects($this->once())
            ->method('handle');

        $this->requestLoggerMiddleware->process($this->request, $this->handler);
    }
}
