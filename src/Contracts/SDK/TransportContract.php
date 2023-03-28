<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\SDK;

use Http\Client\HttpClient;
use Http\Discovery\Exception\NotFoundException;

interface TransportContract
{
    /**
     * Return the discovered Http Client.
     * @return HttpClient
     * @throws NotFoundException
     */
    public static function client(): HttpClient;
}
