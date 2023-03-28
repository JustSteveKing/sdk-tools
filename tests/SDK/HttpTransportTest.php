<?php

declare(strict_types=1);

use Http\Client\HttpClient;
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

it('can find the installed implementation', function (): void {
    expect(
        HttpTransport::client(),
    )->toBeInstanceOf(HttpClient::class);
});
