<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\Http;

use Psr\Http\Message\RequestInterface;

interface RequestContract
{
    /**
     * Turn the Request into a PSR-7 Message.
     * @return RequestInterface
     */
    public function toPsrRequest(): RequestInterface;
}
