<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client;

use GuzzleHttp\Exception\BadResponseException;
use JTL\OpsGenie\Client\Alert\CloseAlertRequest;
use JTL\OpsGenie\Client\Alert\CloseAlertResponse;
use JTL\OpsGenie\Client\Alert\CreateAlertRequest;
use JTL\OpsGenie\Client\Alert\CreateAlertResponse;
use JTL\OpsGenie\Client\Alert\GetAlertRequest;
use JTL\OpsGenie\Client\Alert\GetAlertResponse;
use JTL\OpsGenie\Client\Heartbeat\PingRequest;
use JTL\OpsGenie\Client\Heartbeat\PingResponse;
use Psr\Http\Message\ResponseInterface;

final readonly class HeartbeatApiClient
{
    /**
     * HeartbeatApiClient constructor.
     */
    public function __construct(private HttpClient $client)
    {
    }

    /**
     * @param PingRequest $request
     * @return PingResponse&OpsGenieResponse
     * @throws Exception\ApiRequestFailException
     */
    public function sendPing(PingRequest $request): PingResponse
    {
        /** @var PingResponse $response */
        $response = $this->client->request($request, PingResponse::class);
        return $response;
    }
}
