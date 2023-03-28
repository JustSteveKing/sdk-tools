<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\Http;

use JsonException;
use Psr\Http\Message\ResponseInterface;

interface ResponseContract
{
    /**
     * Return the Response status code.
     * @return int
     */
    public function status(): int;

    /**
     * Return the JSON payload as an array.
     * @return array
     */
    public function json(): array;

    /**
     * Return the response headers.
     * @return array
     */
    public function headers(): array;

    /**
     * Return the response HTTP protocol.
     * @return string
     */
    public function protocol(): string;

    /**
     * Return the response reason phrase for the status code.
     * @return string
     */
    public function reason(): string;

    /**
     * Transform a PSR Response into a Response.
     * @param ResponseInterface $response
     * @return ResponseContract
     * @throws JsonException
     */
    public static function fromPsrResponse(ResponseInterface $response): ResponseContract;
}
