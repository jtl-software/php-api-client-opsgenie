<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */
declare(strict_types=1);


namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieResponse;

class CloseAlertResponse extends OpsGenieResponse
{
    public function isSuccessful(): bool
    {
        return $this->getStatusCode() === 202;
    }
}
