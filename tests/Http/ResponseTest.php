<?php

declare(strict_types=1);

use Http\Discovery\Psr17FactoryDiscovery;
use JustSteveKing\Tools\Contracts\Http\ResponseContract;
use JustSteveKing\Tools\Http\Enums\Status;
use JustSteveKing\Tools\Http\Payload;
use JustSteveKing\Tools\Http\Response;

it('can manually create a response', function (string $string): void {
    expect(
        new Response(
            status: Status::OK->value,
            json: ['foo' => 'bar'],
            headers: ['Content-Type' => 'application/json'],
            protocol: $string,
            reason: $string,
        ),
    )->toBeInstanceOf(ResponseContract::class);
})->with('strings');

it('can create a response from a PSR response', function (string $string): void {
    $response = Psr17FactoryDiscovery::findResponseFactory()->createResponse(
        Status::OK->value,
        $string,
    );

    $response->withBody(
        (new Payload(
            content: '{"foo": "bar"}',
        ))->toStream(),
    );

    expect(
        Response::fromPsrResponse(
            response: $response,
        ),
    )->toBeInstanceOf(ResponseContract::class);
})->with('strings');

it('can access parts of the request', function (string $string): void {
    $response = Psr17FactoryDiscovery::findResponseFactory()->createResponse(
        Status::OK->value,
        $string,
    );

    $response->withBody(
        (new Payload(
            content: '{"foo": "bar"}',
        ))->toStream(),
    );

    $response = Response::fromPsrResponse(
        response: $response,
    );

    expect(
        $response->status(),
    )->toBeInt()->toEqual(Status::OK->value)->and(
        $response->headers()
    )->toBeArray()->toBeEmpty()->and(
        $response->protocol(),
    )->toBeString()->toEqual('1.1')->and(
        $response->reason(),
    )->toBeString()->toEqual($string)->and(
        $response->json(),
    )->toBeArray();
})->with('strings');
