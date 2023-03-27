<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http\Headers;

use JustSteveKing\Tools\Contracts\Http\HeaderContract;

final readonly class Authorization implements HeaderContract
{
    /**
     * @param string $value The Authorization header value.
     * @param string $type The type of Authorization being used.
     */
    public function __construct(
        public string $value,
        public string $type = 'Bearer',
    ) {}

    /**
     * @inheritDoc
     */
    public function toHeader(): array
    {
        return [
            'Authorization' => $this->type . ' ' . $this->value,
        ];
    }
}
