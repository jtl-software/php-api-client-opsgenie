<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieRequest;

class GetAlertRequest implements OpsGenieRequest
{
    /**
     * GetAlertRequest constructor.
     */
    public function __construct(private readonly string $alias)
    {
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return "GET";
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        $_ = urlencode($this->alias);
        return "alerts/{$_}?identifierType=alias";
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return [];
    }
}
