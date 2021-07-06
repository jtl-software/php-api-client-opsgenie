<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */

namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieRequest;
use JTL\OpsGenie\Client\Priority;
use JTL\OpsGenie\Client\Responder;

class CreateAlertRequest implements OpsGenieRequest
{
    /**
     * @var Alert
     */
    private $alert;

    /**
     * CreateAlertRequest constructor.
     * @param Alert $alert
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return "POST";
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return "alerts";
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        $body = [
            "entity" => $this->alert->getEntity(),
            "alias" => $this->alert->getAlias(),
            "message" => $this->alert->getMessage(),
            "source" => $this->alert->getSource(),
            "priority" => (string)$this->alert->getPriority()
        ];

        if (!empty($this->alert->getDescription())) {
            $body['description'] = $this->alert->getDescription();
        }

        if (!empty($this->alert->getTags())) {
            $body['tags'] = $this->alert->getTags();
        }

        foreach ($this->alert->getResponders() as $responder) {
            $body['responders'][] = [
                'id' => $responder->getId(),
                'type' => $responder->getType()
            ];
        }

        return $body;
    }
}
