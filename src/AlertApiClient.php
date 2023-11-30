<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client;

use JTL\OpsGenie\Client\Alert\AckAlertRequest;
use JTL\OpsGenie\Client\Alert\AckAlertResponse;
use JTL\OpsGenie\Client\Alert\CloseAlertRequest;
use JTL\OpsGenie\Client\Alert\CloseAlertResponse;
use JTL\OpsGenie\Client\Alert\CreateAlertRequest;
use JTL\OpsGenie\Client\Alert\CreateAlertResponse;
use JTL\OpsGenie\Client\Alert\GetAlertRequest;
use JTL\OpsGenie\Client\Alert\GetAlertResponse;
use JTL\OpsGenie\Client\Exception\ApiRequestFailException;

final readonly class AlertApiClient
{
    public function __construct(private HttpClient $client)
    {
    }

    /**
     * @return CreateAlertResponse&OpsGenieResponse
     * @throws ApiRequestFailException
     */
    public function createAlert(CreateAlertRequest $request): CreateAlertResponse
    {
        /** @var CreateAlertResponse $response */
        $response = $this->client->request($request, CreateAlertResponse::class);
        return $response;
    }

    /**
     * @return GetAlertResponse&OpsGenieResponse
     * @throws ApiRequestFailException
     */
    public function getAlert(GetAlertRequest $request): GetAlertResponse
    {
        /** @var GetAlertResponse $response */
        $response = $this->client->request($request, GetAlertResponse::class);
        return $response;
    }

    /**
     * @return CloseAlertResponse&OpsGenieResponse
     * @throws ApiRequestFailException
     */
    public function closeAlert(CloseAlertRequest $request): CloseAlertResponse
    {
        /** @var CloseAlertResponse $response */
        $response = $this->client->request($request, CloseAlertResponse::class);
        return $response;
    }

    /**
     * @return AckAlertResponse&OpsGenieResponse
     * @throws ApiRequestFailException
     */
    public function ackAlert(AckAlertRequest $request): AckAlertResponse
    {
        /** @var AckAlertResponse $response */
        $response = $this->client->request($request, AckAlertResponse::class);
        return $response;
    }
}
