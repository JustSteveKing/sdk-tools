<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Http;

use JustSteveKing\Tools\Contracts\Http\ResponseContract;
use Psr\Http\Message\ResponseInterface;

final class Response implements ResponseContract
{
    /**
     * @param int $status
     * @param array $json
     * @param array $headers
     * @param string $protocol
     * @param string $reason
     */
    public function __construct(
        private readonly int $status,
        private readonly array $json,
        private readonly array $headers,
        private readonly string $protocol,
        private readonly string $reason,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function status(): int
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function json(): array
    {
        return $this->json;
    }

    /**
     * @inheritDoc
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function protocol(): string
    {
        return $this->protocol;
    }

    /**
     * @inheritDoc
     */
    public function reason(): string
    {
        return $this->reason;
    }

    /**
     * @inheritDoc
     */
    public static function fromPsrResponse(ResponseInterface $response): ResponseContract
    {
        $content = json_decode(
            json: $response->getBody()->getContents(),
            associative: true,
        );

        return new Response(
            status: $response->getStatusCode(),
            json: (array) $content,
            headers: $response->getHeaders(),
            protocol: $response->getProtocolVersion(),
            reason: $response->getReasonPhrase(),
        );
    }
}
