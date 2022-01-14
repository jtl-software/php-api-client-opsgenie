<?php

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieResponse;

class AckAlertResponse extends OpsGenieResponse
{
    public function isSuccessful(): bool
    {
        return 202 === $this->getStatusCode();
    }
}
