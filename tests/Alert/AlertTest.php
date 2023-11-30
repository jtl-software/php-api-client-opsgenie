<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/28/18
 */

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\Priority;
use JTL\OpsGenie\Client\Responder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \JTL\OpsGenie\Client\Alert\Alert
 * @uses   \JTL\OpsGenie\Client\Priority
 */
class AlertTest extends TestCase
{
    public function testCanCreateAlertWithDefaultPriority(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertInstanceOf(Alert::class, $alert);
        $this->assertEquals(Priority::moderate(), $alert->getPriority());
    }

    public function testCanCreateAlertWithPriority(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source", Priority::informational());
        $this->assertInstanceOf(Alert::class, $alert);
        $this->assertEquals(Priority::informational(), $alert->getPriority());
    }

    public function testCanReadEntity(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertEquals("entity", $alert->getEntity());
    }

    public function testCanReadAlias(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertEquals("alias", $alert->getAlias());
    }

    public function testCanReadMessage(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertEquals("message", $alert->getMessage());
    }

    public function testCanReadSource(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertEquals("source", $alert->getSource());
    }

    public function testDescriptionIsOptional(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");

        $this->assertNull($alert->getDescription());
    }

    public function testCanSetDescription(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");

        $alert->setDescription("dingens");
        $this->assertEquals("dingens", $alert->getDescription());
    }

    public function testResponderIsOptional(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertEmpty($alert->getResponders());
    }

    public function testSetResponder(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $alert->appendResponder($this->createMock(Responder::class));

        $this->assertCount(1, $alert->getResponders());
    }

    public function testTagIsOptional(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $this->assertEmpty($alert->getTags());
    }

    public function testAppendTag(): void
    {
        $alert = new Alert("entity", 'alias', "message", "source");
        $alert->appendTag('foo')
            ->appendTag(2);

        $this->assertCount(2, $alert->getTags());
        $this->assertEquals(['foo', '2'], $alert->getTags());
    }
}
