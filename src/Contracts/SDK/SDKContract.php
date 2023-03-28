<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\SDK;

use Http\Client\HttpClient;

interface SDKContract
{
    /**
     * Return the attached HTTP Client.
     * @return HttpClient
     */
    public function client(): HttpClient;

    /**
     * Replace the attached HTTP Client.
     * @param HttpClient $client
     * @return SDKContract
     */
    public function setClient(HttpClient $client): SDKContract;
}
