<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http;

use Http\Discovery\Psr17FactoryDiscovery;
use JustSteveKing\Tools\Contracts\Http\PayloadContract;
use Psr\Http\Message\StreamInterface;

final readonly class Payload implements PayloadContract
{
    public function __construct(
        private string $content,
    ) {}

    public function toStream(): StreamInterface
    {
        return Psr17FactoryDiscovery::findStreamFactory()->createStream(
            $this->content,
        );
    }
}
