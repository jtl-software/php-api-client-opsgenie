<?php

/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 1/14/19
 */
declare(strict_types=1);

namespace JTL\OpsGenie\Client;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use JTL\OpsGenie\Client\Exception\ApiRequestFailException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class HttpClient
{
    /**
     * @return HttpClient
     */
    public static function createForUSApi(string $authToken, string $version = '2', int $timeout = 5): HttpClient
    {
        $guzzleClient = new Client(
            [
                'base_uri' => "https://api.opsgenie.com/v{$version}/",
                RequestOptions::TIMEOUT => $timeout,
            ]
        );
        return new HttpClient($authToken, $guzzleClient);
    }

    /**
     * @return HttpClient
     */
    public static function createForEUApi(string $authToken, string $version = '2', int $timeout = 5): HttpClient
    {
        $guzzleClient = new Client(
            [
                'base_uri' => "https://api.eu.opsgenie.com/v{$version}/",
                RequestOptions::TIMEOUT => $timeout,
            ]
        );
        return new HttpClient($authToken, $guzzleClient);
    }

    /**
     * HttpClient constructor.
     */
    public function __construct(protected string $authToken, protected Client $client)
    {
    }

    /**
     * @return OpsGenieResponse
     * @throws ApiRequestFailException
     */
    public function request(OpsGenieRequest $request, string $responseType): OpsGenieResponse
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

                if ($request->getBody() !== []) {
                    $option['body'] = \GuzzleHttp\json_encode($request->getBody());
                }
            }

            $response = $this->client->request($request->getHttpMethod(), $request->getUrl(), $option);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        } catch (GuzzleException|Exception $e) {
            $msg = $e::class . ": " . $e->getMessage();
            throw new ApiRequestFailException($msg, $e->getCode(), $e);
        }

        return $this->createResponse($response, $responseType);
    }

    /**
     * @param ResponseInterface $response
     * @param string $objectName
     * @return OpsGenieResponse
     * @throws JsonException
     */
    private function createResponse(ResponseInterface $response, string $objectName): OpsGenieResponse
    {
        $responseObject = new $objectName(
            $response->getStatusCode(),
            $this->getBodyAsArray((string)$response->getBody())
        );
        if ($responseObject instanceof OpsGenieResponse) {
            return $responseObject;
        }

        throw new RuntimeException(
            "Response object must be an instance of " . OpsGenieResponse::class . " but got " . $objectName
        );
    }

    /**
     * @param string $body
     * @return array
     * @throws JsonException
     */
    protected function getBodyAsArray(string $body): array
    {
        return json_decode($body, true, JSON_THROW_ON_ERROR, JSON_THROW_ON_ERROR);
    }
}
