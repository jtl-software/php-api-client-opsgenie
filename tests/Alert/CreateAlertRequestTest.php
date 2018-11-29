<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\Priority;
use JTL\OpsGenie\Client\Responder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \JTL\OpsGenie\Client\Alert\CreateAlertRequest
 * @uses   \JTL\OpsGenie\Client\Priority
 */
class CreateAlertRequestTest extends TestCase
{
    public function testCanCreateAlertRequest()
    {
        $alert = $this->createMock(Alert::class);
        $request = new CreateAlertRequest($alert);
        $this->assertInstanceOf(CreateAlertRequest::class, $request);
    }

    public function testCanSetDescription()
    {
        $alert = $this->createMock(Alert::class);
        $alert->expects($this->atLeastOnce())->method('getDescription')->willReturn('foo mag bar');
        $request = new CreateAlertRequest($alert);

        $this->assertArrayHasKey('description', $request->getBody());
    }

    public function testCanAppendResponder()
    {
        $alert = $this->createMock(Alert::class);
        $alert->expects($this->atLeastOnce())->method('getResponders')->willReturn([
            $this->createMock(Responder::class),
            $this->createMock(Responder::class)
        ]);
        $request = new CreateAlertRequest($alert);

        $this->assertArrayHasKey('responders', $request->getBody());
    }

    public function testCanAppendTags()
    {
        $alert = $this->createMock(Alert::class);
        $alert->expects($this->atLeastOnce())->method('getTags')->willReturn(['foo', 'bar']);
        $request = new CreateAlertRequest($alert);

        $this->assertArrayHasKey('tags', $request->getBody());
    }

    public function testCanGetRequestBody()
    {
        $alert = $this->createMock(Alert::class);
        $alert->expects($this->atLeastOnce())->method('getEntity')
            ->willReturn('entity');
        $alert->expects($this->atLeastOnce())->method('getAlias')
            ->willReturn('alias');
        $alert->expects($this->atLeastOnce())->method('getMessage')
            ->willReturn('message');
        $alert->expects($this->atLeastOnce())->method('getSource')
            ->willReturn('source');

        $alert->expects($this->atLeastOnce())->method('getPriority')
            ->willReturn($this->createMock(Priority::class));

        $request = new CreateAlertRequest($alert);

        $body = $request->getBody();
        $this->assertArrayHasKey('entity', $body);
        $this->assertArrayHasKey('alias', $body);
        $this->assertArrayHasKey('message', $body);
        $this->assertArrayHasKey('source', $body);
        $this->assertArrayHasKey('priority', $body);
    }

    public function testHttpMethodIsPost()
    {
        $request = new CreateAlertRequest($this->createMock(Alert::class));
        $this->assertEquals('POST', $request->getHttpMethod());
    }

    public function testUrlIsAlerts()
    {
        $request = new CreateAlertRequest($this->createMock(Alert::class));
        $this->assertEquals('alerts', $request->getUrl());
    }
}
