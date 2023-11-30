<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/22/18
 */

namespace JTL\OpsGenie\Client;

use PHPUnit\Framework\TestCase;

/**
 * @covers \JTL\OpsGenie\Client\Priority
 */
class PriorityTest extends TestCase
{
    public function testCanCreateCritical(): void
    {
        $this->assertInstanceOf(Priority::class, Priority::critical());
    }

    public function testCanCreateHigh(): void
    {
        $this->assertInstanceOf(Priority::class, Priority::high());
    }

    public function testCanCreateModerate(): void
    {
        $this->assertInstanceOf(Priority::class, Priority::moderate());
    }

    public function testCanCreateLow(): void
    {
        $this->assertInstanceOf(Priority::class, Priority::low());
    }

    public function testCanCreateInformational(): void
    {
        $this->assertInstanceOf(Priority::class, Priority::informational());
    }

    public function testCanCastToString(): void
    {
        $this->assertEquals('P5', (string)Priority::informational());
    }
}
