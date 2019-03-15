<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 1/14/19
 */
declare(strict_types=1);


namespace JTL\OpsGenie\Client\Heartbeat;


use JTL\OpsGenie\Client\OpsGenieResponse;

class PingResponse extends OpsGenieResponse
{

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->getStatusCode() === 202;
    }
}
