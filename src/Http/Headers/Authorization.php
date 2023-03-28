<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http\Headers;

use JustSteveKing\Tools\Contracts\Http\HeaderContract;

final class Authorization implements HeaderContract
{
    /**
     * @param string $value The Authorization header value.
     * @param string $type The type of Authorization being used.
     */
    public function __construct(
        public readonly string $value,
        public readonly string $type = 'Bearer',
    ) {
    }

    /**
     * @inheritDoc
     */
    public function toHeader(): array
    {
        return [
            'Authorization' => $this->type.' '.$this->value,
        ];
    }
}
