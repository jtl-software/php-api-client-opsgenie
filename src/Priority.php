<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */

namespace JTL\OpsGenie\Client;

class Priority implements \Stringable
{
    private const critical = "P1";
    private const high = "P2";
    private const moderate = "P3";
    private const low = "P4";
    private const informational = "P5";

    public static function critical(): Priority
    {
        return new Priority(Priority::critical);
    }

    public static function high(): Priority
    {
        return new Priority(Priority::high);
    }

    public static function moderate(): Priority
    {
        return new Priority(Priority::moderate);
    }

    public static function low(): Priority
    {
        return new Priority(Priority::low);
    }

    public static function informational(): Priority
    {
        return new Priority(Priority::informational);
    }

    public function __construct(private readonly string $priority)
    {
    }

    public function __toString(): string
    {
        return $this->priority;
    }
}
