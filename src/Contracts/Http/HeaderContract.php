<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\Http;

interface HeaderContract
{
    /**
     * Return the class in a format that works for HTTP Headers.
     * @return array<string,string>
     */
    public function toHeader(): array;
}
