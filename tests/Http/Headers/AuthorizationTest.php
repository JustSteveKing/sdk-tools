<?php

declare(strict_types=1);

use JustSteveKing\Tools\Http\Headers\Authorization;

it('can create a new authorization header', function (string $credentials): void {
    expect(
        (new Authorization(
            value: $credentials,
        ))->toHeader(),
    )->toBeArray()->toEqual([
        'Authorization' => 'Bearer '.$credentials,
    ]);
})->with('credentials');

it('can change the type of Authorization header', function (string $type): void {
    expect(
        (new Authorization(
            value: 'test',
            type: $type,
        ))->toHeader(),
    )->toBeArray()->toEqual([
        'Authorization' => $type.' test',
    ]);
})->with('types');
