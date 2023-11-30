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
 * @covers \JTL\OpsGenie\Client\Alert\GetAlertRequest
 */
class GetAlertRequestTest extends TestCase
{
    public function testCanCreateCorrectUrl(): void
    {
        $get = new GetAlertRequest('alias');
        $this->assertEquals('alerts/alias?identifierType=alias', $get->getUrl());
    }

    public function testCanCreateCorrectUrlEncodedUrl(): void
    {
        $get = new GetAlertRequest('a l i a s / foo . 1');
        $this->assertEquals('alerts/a+l+i+a+s+%2F+foo+.+1?identifierType=alias', $get->getUrl());
    }

    public function testGetBody(): void
    {
        $get = new GetAlertRequest('alias');
        $this->assertEquals([], $get->getBody());
    }

    public function testGetHttpMethod(): void
    {
        $get = new GetAlertRequest('alias');
        $this->assertEquals('GET', $get->getHttpMethod());
    }
}
