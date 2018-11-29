<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */

namespace JTL\OpsGenie\Client;

use PHPUnit\Framework\TestCase;

/**
 * @covers \JTL\OpsGenie\Client\ErrorResponse
 * @uses \JTL\OpsGenie\Client\OpsGenieResponse
 */
class ErrorResponseTest extends TestCase
{
    public function testIsNotSuccessful()
    {
        $err = new ErrorResponse(1, []);
        $this->assertFalse($err->isSuccessful());
    }
}
