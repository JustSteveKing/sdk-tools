<?php

declare(strict_types=1);

namespace JustSteveKing\Tools\Contracts\SDK;

/**
 * @property-read SDKContract $sdk
 */
interface ResourceContract
{
    /**
     * Return the injected SDK.
     * @return SDKContract
     */
    public function sdk(): SDKContract;
}
