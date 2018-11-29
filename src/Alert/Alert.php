<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/28/18
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\Priority;
use JTL\OpsGenie\Client\Responder;

class Alert
{

    /**
     * Entity field of the alert that is generally used to specify which domain alert is related to.
     *
     * @var string
     */
    private $entity;

    /**
     * Client-defined identifier of the alert, that is also the key element of Alert De-Duplication.
     *
     * @var string
     */
    private $alias;

    /**
     * Message of the alert
     *
     * @var string
     */
    private $message;

    /**
     * Description field of the alert that is generally used to provide a detailed information about the alert.
     *
     * @var string
     */
    private $description;

    /**
     * Teams, users, escalations and schedules that the alert will be routed to send notifications. type field is
     * mandatory for each item, where possible values are team, user, escalation and schedule. If the API Key belongs
     * to a team integration, this field will be overwritten with the owner team. Either id or name of each responder
     * should be provided.You can refer below for example values.
     *
     * @var Responder[]
     */
    private $responders = [];

    /**
     * Tags of the alert.
     *
     * @var array
     */
    private $tags = [];

    /**
     * Source field of the alert. Default value is IP address of the incoming request.
     *
     * @var string
     */
    private $source;

    /**
     * Priority level of the alert. Possible values are P1, P2, P3, P4 and P5. Default value is P3.
     *
     * @var Priority
     */
    private $priority;

    /**
     * CreateAlertRequest constructor.
     * @param string $entity
     * @param string $alias
     * @param string $message
     * @param string $source
     * @param Priority $priority
     */
    public function __construct(string $entity, string $alias, string $message, string $source, Priority $priority = null)
    {
        $this->entity = $entity;
        $this->alias = $alias;
        $this->message = $message;
        $this->source = $source;
        $this->priority = $priority;
        if ($this->priority === null) {
            $this->priority = Priority::moderate();
        }
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param Responder $responder
     */
    public function appendResponder(Responder $responder): void
    {
        $this->responders[] = $responder;
    }

    /**
     * @return Responder[]
     */
    public function getResponders(): array
    {
        return $this->responders;
    }

    /**
     * @param string $tag
     *
     * @return Alert
     */
    public function appendTag(string $tag): Alert
    {
        $this->tags[] = substr($tag, 0, 20);
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return Priority
     */
    public function getPriority(): Priority
    {
        return $this->priority;
    }
}
