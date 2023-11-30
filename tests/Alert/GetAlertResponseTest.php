<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/29/18
 */

namespace JTL\OpsGenie\Client\Alert;

use PHPUnit\Framework\TestCase;

/**
 * Class GetAlertResponseTest
 * @covers \JTL\OpsGenie\Client\Alert\GetAlertResponse
 * @uses \JTL\OpsGenie\Client\OpsGenieResponse
 * @uses \JTL\OpsGenie\Client\Alert\Alert
 * @uses \JTL\OpsGenie\Client\Priority
 * @uses \JTL\OpsGenie\Client\Responder
 */
class GetAlertResponseTest extends TestCase
{
    public function testIsSuccessful(): void
    {
        $response = new GetAlertResponse(200, []);
        $this->assertTrue($response->isSuccessful());
    }

    public function testCanConstructAlertFromResponse(): void
    {
        $response = new GetAlertResponse(200, [
            'data' => [
                'entity' => 'entity',
                'alias' => 'alias',
                'message' => 'message',
                'source' => 'source',
                'priority' => 'P1',
                'tags' => ["1","2","3"],
                'description' => "foo mag bar",
                'responders' => [
                    ['id' => 1, 'type' => 'foo'],
                    ['id' => 2, 'type' => 'ba']
                ]
            ]
        ]);
        $this->assertInstanceOf(Alert::class, $response->getAlert());
    }

    public function testNoAlertIsConstructedWhenNoData(): void
    {
        $response = new GetAlertResponse(200, []);
        $this->assertNull($response->getAlert());
    }
}
