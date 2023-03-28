<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\Http;

use Psr\Http\Message\StreamInterface;

interface PayloadContract
{
    /**
     * Turn the Request payload into a HTTP Stream.
     * @return StreamInterface
     */
    public function toStream(): StreamInterface;
}
