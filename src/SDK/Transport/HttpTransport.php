<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\SDK\Transport;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use JustSteveKing\Tools\Contracts\SDK\TransportContract;

final class HttpTransport implements TransportContract
{
    /**
     * @inheritDoc
     */
    public static function client(): HttpClient
    {
        return HttpClientDiscovery::find();
    }
}
