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
use Psr\Http\Message\ResponseInterface;

final class AlertApiClient
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $authToken;

    /**
     * OpsGenieApiClient constructor.
     *
     * @param string $authToken
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(string $authToken, \GuzzleHttp\Client $client)
    {
        $this->authToken = $authToken;
        $this->client = $client;
    }

    /**
     * Create Client for US Customers
     *
     * @param string $authToken
     * @param string $version
     * @return AlertApiClient
     */
    public static function createForUSApi(string $authToken, string $version = '2'): AlertApiClient
    {
        $guzzleClient = new \GuzzleHttp\Client(['base_uri' => "https://api.opsgenie.com/v{$version}/"]);
        return new AlertApiClient($authToken, $guzzleClient);
    }

    /**
     * Create Client fpr European Customers
     *
     * @param string $authToken
     * @param string $version
     * @return AlertApiClient
     */
    public static function createForEUApi(string $authToken, string $version = '2'): AlertApiClient
    {
        $guzzleClient = new \GuzzleHttp\Client(['base_uri' => "https://api.eu.opsgenie.com/v{$version}/"]);
        return new AlertApiClient($authToken, $guzzleClient);
    }

    /**
     * @param CreateAlertRequest $request
     * @return CreateAlertResponse|OpsGenieResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createAlert(CreateAlertRequest $request): CreateAlertResponse
    {
        return $this->createResponse($this->request($request), CreateAlertResponse::class);
    }

    /**
     * @param GetAlertRequest $request
     * @return GetAlertResponse|OpsGenieResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAlert(GetAlertRequest $request): GetAlertResponse
    {
        return $this->createResponse($this->request($request), GetAlertResponse::class);
    }

    /**
     * @param CloseAlertRequest $request
     * @return CloseAlertResponse|OpsGenieResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function closeAlert(CloseAlertRequest $request): CloseAlertResponse
    {
        return $this->createResponse($this->request($request), CloseAlertResponse::class);
    }

    /**
     * @param OpsGenieRequest $request
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(OpsGenieRequest $request): ResponseInterface
    {
        try {
            $option = [
                'headers' => [
                    'Authorization' => 'GenieKey ' . $this->authToken,
                    'Content-Type' => 'application/json',
                ],
                // 'debug' => true
            ];

            if ($request->getHttpMethod() !== "GET") {

                //add default empty body as default because php  will otherwise create a [] as body
                $option['body'] = "{}";

                if (!empty($request->getBody())) {
                    $option['body'] = \GuzzleHttp\json_encode($request->getBody());
                }
            }

            return $this->client->request($request->getHttpMethod(), $request->getUrl(), $option);
        } catch (BadResponseException $e) {
            return $e->getResponse();
        }
    }

    /**
     * @param ResponseInterface $response
     * @param string $objectName
     * @return OpsGenieResponse
     */
    private function createResponse(ResponseInterface $response, string $objectName): OpsGenieResponse
    {
        return new $objectName($response->getStatusCode(), $this->getBodyAsArray((string)$response->getBody()));
    }

    /**
     * @param string $body
     * @return array
     */
    private function getBodyAsArray(string $body): array
    {
        return \GuzzleHttp\json_decode($body, true);
    }
}
