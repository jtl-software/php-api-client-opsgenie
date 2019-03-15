<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 3/15/19
 */

namespace JTL\OpsGenie\Client\Heartbeat;

use PHPUnit\Framework\TestCase;

/**
 * Class PingResponseTest
 * @covers \JTL\OpsGenie\Client\Heartbeat\PingResponse
 * @uses \JTL\OpsGenie\Client\OpsGenieResponse
 */
class PingResponseTest extends TestCase
{

    public function testIsSuccessful()
    {
        $response = new PingResponse(202, []);
        $this->assertTrue($response->isSuccessful());
    }

    public function testIsNotSuccessful()
    {
        $response = new PingResponse(500, []);
        $this->assertFalse($response->isSuccessful());
    }
}
