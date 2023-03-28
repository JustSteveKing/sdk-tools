<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http\Headers;

use JustSteveKing\Tools\Contracts\Http\HeaderContract;

final class TokenHeader implements HeaderContract
{
    /**
     * @param string $value The API Token you want to use.
     * @param string $key The Header key you want to use.
     */
    public function __construct(
        public readonly string $value,
        public readonly string $key = 'X-API-TOKEN',
    ) {
    }

    /**
     * @inheritDoc
     */
    public function toHeader(): array
    {
        return [
            $this->key => $this->value,
        ];
    }
}
