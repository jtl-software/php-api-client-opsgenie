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
 * @covers \JTL\OpsGenie\Client\OpsGenieResponse
 */
class OpsGenieResponseTest extends TestCase
{
    public function testGetMessage()
    {
        $response = new TestResponse(200, ['message' => "foo"]);
        $this->assertEquals('foo', $response->getMessage());
    }

    public function testGetStatusCode()
    {
        $response = new TestResponse(200, []);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetRequestId()
    {
        $response = new TestResponse(200, ['requestId' => '123-456']);
        $this->assertEquals('123-456', $response->getRequestId());
    }

    public function testGetFromBody()
    {
        $response = new TestResponse(200, ['requestId' => '123-456']);
        $this->assertEquals('123-456', $response->getFromBody('requestId'));
    }
}

class TestResponse extends OpsGenieResponse
{
    public function isSuccessful(): bool
    {
        return true;
    }
}
