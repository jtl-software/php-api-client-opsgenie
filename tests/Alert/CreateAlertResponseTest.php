<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */

namespace JTL\OpsGenie\Client\Alert;

use PHPUnit\Framework\TestCase;

/**
 * @covers \JTL\OpsGenie\Client\Alert\CreateAlertResponse
 * @uses \JTL\OpsGenie\Client\OpsGenieResponse
 */
class CreateAlertResponseTest extends TestCase
{
    public function testHttpCode202IsSuccessful(): void
    {
        $response = new CreateAlertResponse(202, []);
        $this->assertTrue($response->isSuccessful());
    }
}
