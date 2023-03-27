<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\Http;

interface UriContract
{
    /**
     * Return the Uri class to a string.
     * @return string
     */
    public function toString(): string;
}
