<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */

namespace JTL\OpsGenie\Client;

class Responder
{
    final public const team = "team";
    final public const user = "user";
    final public const escalation = "escalation";
    final public const schedule = "schedule";

    /**
     * @return Responder
     */
    public static function team(string $id): self
    {
        return new Responder($id, self::team);
    }

    /**
     * @return Responder
     */
    public static function user(string $id): self
    {
        return new Responder($id, self::user);
    }

    /**
     * @return Responder
     */
    public static function escalation(string $id): self
    {
        return new Responder($id, self::escalation);
    }

    /**
     * @return Responder
     */
    public static function schedule(string $id): self
    {
        return new Responder($id, self::schedule);
    }

    /**
     * Responder constructor.
     */
    public function __construct(private readonly string $id, private readonly string $type)
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
