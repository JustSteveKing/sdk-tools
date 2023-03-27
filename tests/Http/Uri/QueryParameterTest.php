<?php

declare(strict_types=1);

use JustSteveKing\Tools\Http\Uri\QueryParameter;

it('can turn a query parameter into a string', function (mixed $parameter): void {
    expect(
        (new QueryParameter(
            key: 'test',
            value: $parameter,
        ))->toString(),
    )->toBeString()->toEqual('test=' . (string) $parameter);
})->with('parameters');
