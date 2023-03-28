<?php

declare(strict_types=1);

use JustSteveKing\Tools\Http\Payload;
use Psr\Http\Message\StreamInterface;

it('can create a new payload', function (): void {
    $payload = json_encode(
        value: [
            'foo' => 'bar',
        ],
    );

    expect(
        new Payload(
            content: (string) $payload,
        ),
    )->toBeInstanceOf(Payload::class);
});

it('can turn a payload into a stream', function (): void {
    $payload = json_encode(
        value: [
            'foo' => 'bar',
        ],
    );

    expect(
        (new Payload(
            content: (string) $payload,
        ))->toStream(),
    )->toBeInstanceOf(StreamInterface::class);
});
