<?php declare(strict_types=1);

namespace Qlimix\Tests\HttpMiddleware;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\HttpMiddleware\ResponseLoggerMiddleware;
use Qlimix\Log\Logger\Response\ResponseLoggerInterface;

final class ResponseLoggerMiddlewareTest extends TestCase
{
    /** @var MockObject */
    private $responseLogger;

    /** @var MockObject */
    private $request;

    /** @var MockObject */
    private $handler;

    /** @var ResponseLoggerMiddleware() */
    private $responseLoggerMiddleware;

    protected function setUp(): void
    {
        $this->responseLogger = $this->createMock(ResponseLoggerInterface::class);
        $this->responseLoggerMiddleware = new ResponseLoggerMiddleware($this->responseLogger);

        $this->request = $this->createMock(ServerRequestInterface::class);
        $this->handler = $this->createMock(RequestHandlerInterface::class);
    }

    /**
     * @test
     */
    public function shouldLog(): void
    {
        $this->responseLogger->expects($this->once())
            ->method('log');

        $this->handler->expects($this->once())
            ->method('handle');

        $this->responseLoggerMiddleware->process($this->request, $this->handler);
    }
}
