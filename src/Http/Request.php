<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http;

use Http\Discovery\Psr17FactoryDiscovery;
use JustSteveKing\Tools\Contracts\Http\RequestContract;
use JustSteveKing\Tools\Http\Enums\Method;
use Psr\Http\Message\RequestInterface;

final readonly class Request implements RequestContract
{
    /**
     * @param Method $method The request method.
     * @param string $uri The request URI.
     */
    public function __construct(
        public Method $method,
        public string $uri,
    ) {}

    public function toPsrRequest(): RequestInterface
    {
        return Psr17FactoryDiscovery::findRequestFactory()
            ->createRequest(
                $this->method->value,
                $this->uri,
            );
    }
}
