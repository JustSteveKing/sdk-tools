<?php

declare(strict_types=1);

use Http\Client\HttpClient;
use Http\Mock\Client;
use JustSteveKing\Tools\Contracts\SDK\SDKContract;
use JustSteveKing\Tools\SDK\SDK;
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

it('can create a new SDK', function (): void {
    expect(
        new SDK(
            client: HttpTransport::client(),
        ),
    )->toBeInstanceOf(SDKContract::class);
});

it('can get the attached http client from the SDK', function (): void {
    expect(
        (new SDK(
            client: HttpTransport::client(),
        ))->client(),
    )->toBeInstanceOf(HttpClient::class);
});

it('can replace the attached http client on the SDK', function (): void {
    $sdk = new SDK(
        client: HttpTransport::client(),
    );

    expect(
        $sdk->setClient(
            client: new Client(),
        )->client(),
    )->toBeInstanceOf(Client::class);
});
