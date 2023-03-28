<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\SDK;

use JustSteveKing\Tools\Contracts\SDK\ResourceContract;
use JustSteveKing\Tools\Contracts\SDK\SDKContract;

class Resource implements ResourceContract
{
    /**
     * Create a new Resource.
     * @param SDKContract $sdk
     */
    public function __construct(
        protected readonly SDKContract $sdk,
    ) {
    }

    /**
     * Return the injected SDK.
     * @return SDKContract
     */
    public function sdk(): SDKContract
    {
        return $this->sdk;
    }
}
