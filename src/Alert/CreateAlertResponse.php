<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieResponse;

class CreateAlertResponse extends OpsGenieResponse
{
    public function isSuccessful(): bool
    {
        return $this->getStatusCode() == 202;
    }
}
