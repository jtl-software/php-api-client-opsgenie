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
     * Description field of the alert that is generally used to provide a detailed information about the alert.
     */
    private ?string $description = null;

    /**
     * Teams, users, escalations and schedules that the alert will be routed to send notifications. type field is
     * mandatory for each item, where possible values are team, user, escalation and schedule. If the API Key belongs
     * to a team integration, this field will be overwritten with the owner team. Either id or name of each responder
     * should be provided.You can refer below for example values.
     *
     * @var Responder[]
     */
    private array $responders = [];

    /**
     * Tags of the alert.
     */
    private array $tags = [];

    /**
     * CreateAlertRequest constructor.
     * @param Priority $priority
     */
    public function __construct(private readonly string $entity, private readonly string $alias, private readonly string $message, private readonly string $source, private ?\JTL\OpsGenie\Client\Priority $priority = null)
    {
        if (!$this->priority instanceof \JTL\OpsGenie\Client\Priority) {
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
