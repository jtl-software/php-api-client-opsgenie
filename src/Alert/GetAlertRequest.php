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
     * @var string
     */
    private $alias;

    /**
     * GetAlertRequest constructor.
     * @param string $alias
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
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
