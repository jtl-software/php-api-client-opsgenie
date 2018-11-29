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
 * Class CloseAlertRequestTest
 * @covers \JTL\OpsGenie\Client\Alert\CloseAlertRequest
 */
class CloseAlertRequestTest extends TestCase
{
    public function testCanCreateCorrectUrl()
    {
        $request = new CloseAlertRequest('testalert');
        $this->assertStringStartsWith('alerts/testalert/close', $request->getUrl());
    }

    public function testUrlIsUrlEncoded()
    {
        $request = new CloseAlertRequest('test alert/foo');
        $this->assertStringStartsWith('alerts/test+alert%2Ffoo/close', $request->getUrl());
    }

    public function testNotIsOptional()
    {
        $request = new CloseAlertRequest('testalert');
        $this->assertArrayNotHasKey('note', $request->getBody());
    }

    public function testCanSetNote()
    {
        $request = new CloseAlertRequest('testalert');
        $request->setNote('any note');
        $this->assertArrayHasKey('note', $request->getBody());
        $this->assertEquals('any note', $request->getBody()['note']);
    }

    public function testUserIsOptional()
    {
        $request = new CloseAlertRequest('testalert');
        $this->assertArrayNotHasKey('user', $request->getBody());
    }

    public function testCanSetUser()
    {
        $request = new CloseAlertRequest('testalert');
        $request->setUser('any user');
        $this->assertArrayHasKey('user', $request->getBody());
        $this->assertEquals('any user', $request->getBody()['user']);
    }

    public function testSourceIsOptional()
    {
        $request = new CloseAlertRequest('testalert');
        $this->assertArrayNotHasKey('source', $request->getBody());
    }

    public function testCanSetSource()
    {
        $request = new CloseAlertRequest('testalert');
        $request->setSource('any source');
        $this->assertArrayHasKey('source', $request->getBody());
        $this->assertEquals('any source', $request->getBody()['source']);
    }

    public function testCanGetHttpMethod()
    {
        $request = new CloseAlertRequest('testalert');
        $this->assertEquals('POST', $request->getHttpMethod());
    }
}
