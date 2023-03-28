<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http;

use Http\Discovery\Psr17FactoryDiscovery;
use JustSteveKing\Tools\Contracts\Http\PayloadContract;
use Psr\Http\Message\StreamInterface;

final class Payload implements PayloadContract
{
    /**
     * @param string $content The payload content.
     */
    public function __construct(
        private readonly string $content,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function toStream(): StreamInterface
    {
        return Psr17FactoryDiscovery::findStreamFactory()->createStream(
            $this->content,
        );
    }
}
