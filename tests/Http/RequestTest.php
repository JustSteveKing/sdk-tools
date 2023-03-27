<?php

declare(strict_types=1);

use JustSteveKing\Tools\Contracts\Http\RequestContract;
use JustSteveKing\Tools\Http\Enums\Method;
use JustSteveKing\Tools\Http\Request;
use Psr\Http\Message\RequestInterface;

it('can create a new request', function (string $url): void {
    expect(
        new Request(
            method: Method::POST,
            uri: $url,
        ),
    )->toBeInstanceOf(RequestContract::class);
})->with('urls');

it('can turn a request into a PSR request', function (string $url): void {
    expect(
        (new Request(
            method: Method::POST,
            uri: $url,
        ))->toPsrRequest(),
    )->toBeInstanceOf(RequestInterface::class);
})->with('urls');
