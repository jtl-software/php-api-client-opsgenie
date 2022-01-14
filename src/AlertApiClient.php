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

final class AlertApiClient
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * OpsGenieApiClient constructor.
     *
     * @param HttpClient
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param CreateAlertRequest $request
     * @return CreateAlertResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createAlert(CreateAlertRequest $request): CreateAlertResponse
    {
        return $this->client->request($request, CreateAlertResponse::class);
    }

    /**
     * @param GetAlertRequest $request
     * @return GetAlertResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAlert(GetAlertRequest $request): GetAlertResponse
    {
        return $this->client->request($request, GetAlertResponse::class);
    }

    /**
     * @param CloseAlertRequest $request
     * @return CloseAlertResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function closeAlert(CloseAlertRequest $request): CloseAlertResponse
    {
        return $this->client->request($request, CloseAlertResponse::class);
    }

    /**
     * @param CloseAlertRequest $request
     * @return AckAlertResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function ackAlert(AckAlertRequest $request): AckAlertResponse
    {
        return $this->client->request($request, AckAlertResponse::class);
    }
}
