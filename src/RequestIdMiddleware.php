<?php declare(strict_types=1);

namespace Qlimix\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\Id\Generator\UUID\UUID4Generator;
use Qlimix\RequestIdContainer\RequestIdContainer;

final class RequestIdMiddleware implements MiddlewareInterface
{
    private const REQUEST_ID = 'x-request-id';

    /** @var UUID4Generator */
    private $uuidGenerator;

    /** @var RequestIdContainer */
    private $requestIdContainer;

    /**
     * @param UUID4Generator $uuidGenerator
     */
    public function __construct(UUID4Generator $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uuid4 = $this->uuidGenerator->generate()->getUuid4();

        $this->requestIdContainer->set($uuid4);

        return $handler->handle(
            $request->withAttribute(
                self::REQUEST_ID,
                $uuid4
            )
        );
    }
}
