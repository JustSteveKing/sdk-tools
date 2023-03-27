<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http\Uri;

use JustSteveKing\Tools\Contracts\Http\UriContract;

final readonly class QueryParameter implements UriContract
{
    /**
     * @param string $key The Query Parameter key.
     * @param string|int|bool $value The Query Parameter value.
     */
    public function __construct(
        public string $key,
        public string|int|bool $value,
    ) {}

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return $this->key . '=' . (string) $this->value;
    }
}
