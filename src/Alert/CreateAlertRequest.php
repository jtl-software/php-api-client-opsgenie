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
     * CreateAlertRequest constructor.
     */
    public function __construct(private readonly \JTL\OpsGenie\Client\Alert\Alert $alert)
    {
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

        if ($this->alert->getDescription() !== null && $this->alert->getDescription() !== '') {
            $body['description'] = $this->alert->getDescription();
        }

        if ($this->alert->getTags() !== []) {
            $body['tags'] = $this->alert->getTags();
        }

        foreach ($this->alert->getResponders() as $responder) {
            $body['responders'] = [
                'id' => $responder->getId(),
                'type' => $responder->getType()
            ];
        }

        return $body;
    }
}
