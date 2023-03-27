<?php

declare(strict_types=1);

use JustSteveKing\Tools\Http\Headers\TokenHeader;

it('can create a new token header', function (string $credentials): void {
    expect(
        (new TokenHeader(
            value: $credentials,
        ))->toHeader(),
    )->toBeArray()->toEqual([
        'X-API-TOKEN' => $credentials,
    ]);
})->with('credentials');

it('can overwrite the header key', function (string $credentials): void {
    expect(
        (new TokenHeader(
            value: $credentials,
            key: 'X-TOKEN',
        ))->toHeader(),
    )->toBeArray()->toEqual([
        'X-TOKEN' => $credentials,
    ]);
})->with('credentials');
