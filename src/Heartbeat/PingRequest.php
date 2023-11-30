<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 1/14/19
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client\Heartbeat;

use JTL\OpsGenie\Client\OpsGenieRequest;

class PingRequest implements OpsGenieRequest
{
    public function __construct(private readonly string $heartbeat)
    {
    }

    public function getHttpMethod(): string
    {
        return "PUT";
    }

    public function getUrl(): string
    {
        return "heartbeats/{$this->heartbeat}/ping";
    }

    public function getBody(): array
    {
        return [];
    }
}
