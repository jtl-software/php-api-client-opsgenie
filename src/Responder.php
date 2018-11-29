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
    const team = "team";
    const user = "user";
    const escalation = "escalation";
    const schedule = "schedule";

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;

    /**
     * @param string $id
     * @return Responder
     */
    public static function team(string $id)
    {
        return new Responder($id, self::team);
    }

    /**
     * @param string $id
     * @return Responder
     */
    public static function user(string $id)
    {
        return new Responder($id, self::user);
    }

    /**
     * @param string $id
     * @return Responder
     */
    public static function escalation(string $id)
    {
        return new Responder($id, self::escalation);
    }

    /**
     * @param string $id
     * @return Responder
     */
    public static function schedule(string $id)
    {
        return new Responder($id, self::schedule);
    }

    /**
     * Responder constructor.
     * @param string $id
     * @param string $type
     */
    public function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
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
