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
 * @covers \JTL\OpsGenie\Client\Responder
 */
class ResponderTest extends TestCase
{
    public function testCanCreateForTeam()
    {
        $resp = Responder::team('4711');
        $this->assertInstanceOf(Responder::class, $resp);
        $this->assertEquals(Responder::team, $resp->getType());
    }

    public function testCanCreateForUser()
    {
        $resp = Responder::user('4711');
        $this->assertInstanceOf(Responder::class, $resp);
        $this->assertEquals(Responder::user, $resp->getType());
    }

    public function testCanCreateForEscalation()
    {
        $resp = Responder::escalation('4711');
        $this->assertInstanceOf(Responder::class, $resp);
        $this->assertEquals(Responder::escalation, $resp->getType());
    }

    public function testCanCreateForSchedule()
    {
        $resp = Responder::schedule('4711');
        $this->assertInstanceOf(Responder::class, $resp);
        $this->assertEquals(Responder::schedule, $resp->getType());
    }

    public function testCanReadId()
    {
        $resp = new Responder('any-id', 'bar');
        $this->assertEquals('any-id', $resp->getId());
    }

    public function testCanReadType()
    {
        $resp = new Responder('foo', 'any-type');
        $this->assertEquals('any-type', $resp->getType());
    }
}
