<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */
declare(strict_types=1);


namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieResponse;
use JTL\OpsGenie\Client\Priority;
use JTL\OpsGenie\Client\Responder;

class GetAlertResponse extends OpsGenieResponse
{
    public function getAlert(): ?Alert
    {
        $data = $this->getFromBody('data');
        if (!is_array($data)) {
            return null;
        }

        $alert = new Alert(
            $data['entity'],
            $data['alias'],
            $data['message'],
            $data['source'],
            new Priority($data['priority'])
        );

        if (!empty($data['description'])) {
            $alert->setDescription($data['description']);
        }

        foreach ($data['tags'] ?? [] as $tag) {
            $alert->appendTag((string)$tag);
        }

        foreach ($data['responders'] ?? [] as $responder) {
            $alert->appendResponder(
                new Responder((string)$responder['id'], (string)$responder['type'])
            );
        }

        return $alert;
    }

    public function isSuccessful(): bool
    {
        return $this->getStatusCode() === 200;
    }
}
