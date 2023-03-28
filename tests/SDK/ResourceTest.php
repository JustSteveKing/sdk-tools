<?php

declare(strict_types=1);

use Http\Mock\Client;
use JustSteveKing\Tools\Contracts\SDK\SDKContract;
use JustSteveKing\Tools\SDK\Resource;
use JustSteveKing\Tools\SDK\SDK;

beforeEach(fn () => $this->sdk = new SDK(
    client: new Client(),
));

it('can build a new resource', function (): void {
    expect(
        new Resource(
            sdk: $this->sdk,
        ),
    )->toBeInstanceOf(Resource::class);
});

it('can access the underlying SDK', function (): void {
    expect(
        (new Resource(
            sdk: $this->sdk,
        ))->sdk(),
    )->toBeInstanceOf(SDKContract::class);
});
