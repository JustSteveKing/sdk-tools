<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\SDK;

use Http\Client\HttpClient;
use JustSteveKing\Tools\Contracts\SDK\SDKContract;

class SDK implements SDKContract
{
    /**
     * Create a new SDK.
     * @param HttpClient $client
     */
    public function __construct(
        protected HttpClient $client,
    ) {
    }

    /**
     * Return the attached HTTP Client.
     * @return HttpClient
     */
    public function client(): HttpClient
    {
        return $this->client;
    }

    /**
     * Replace the attached HTTP Client.
     * @param HttpClient $client
     * @return SDKContract
     */
    public function setClient(HttpClient $client): SDKContract
    {
        $this->client = $client;

        return $this;
    }
}
