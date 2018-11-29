<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client;

class ErrorResponse extends OpsGenieResponse
{
    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return false;
    }
}
