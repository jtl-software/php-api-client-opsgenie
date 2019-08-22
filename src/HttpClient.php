<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 1/14/19
 */
declare(strict_types=1);


namespace JTL\OpsGenie\Client;


use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param string $authToken
     * @param string $version
     * @return HttpClient
     */
    public static function createForUSApi(string $authToken, string $version = '2', int $timeout = 5): HttpClient
    {
        $guzzleClient = new \GuzzleHttp\Client(
            [
                'base_uri' => "https://api.opsgenie.com/v{$version}/",
                RequestOptions::TIMEOUT => $timeout,
            ]
        );
        return new HttpClient($authToken, $guzzleClient);
    }

    /**
     * @param string $authToken
     * @param string $version
     * @return HttpClient
     */
    public static function createForEUApi(string $authToken, string $version = '2', int $timeout = 5): HttpClient
    {
        $guzzleClient = new \GuzzleHttp\Client(
            [
                'base_uri' => "https://api.eu.opsgenie.com/v{$version}/",
                RequestOptions::TIMEOUT => $timeout,
            ]
        );
        return new HttpClient($authToken, $guzzleClient);
    }

    /**
     * HttpClient constructor.
     * @param string $authToken
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(string $authToken, \GuzzleHttp\Client $client)
    {
        $this->authToken = $authToken;
        $this->client = $client;
    }

    /**
     * @param OpsGenieRequest $request
     * @param string $responseType
     * @return OpsGenieResponse
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

                if (!empty($request->getBody())) {
                    $option['body'] = \GuzzleHttp\json_encode($request->getBody());
                }
            }

            $response = $this->client->request($request->getHttpMethod(), $request->getUrl(), $option);
        } catch (BadResponseException $e) {
            $response =  $e->getResponse();
        } catch (\GuzzleHttp\Exception\GuzzleException|\Exception $e) {
            $msg = get_class($e) . ": " . $e->getMessage();
            throw new \RuntimeException($msg, $e->getCode());
        }

        return $this->createResponse($response, $responseType);
    }

    /**
     * @param ResponseInterface $response
     * @param string $objectName
     * @return OpsGenieResponse
     */
    public function createResponse(ResponseInterface $response, string $objectName): OpsGenieResponse
    {
        return new $objectName($response->getStatusCode(), $this->getBodyAsArray((string)$response->getBody()));
    }

    /**
     * @param string $body
     * @return array
     */
    protected function getBodyAsArray(string $body): array
    {
        return \GuzzleHttp\json_decode($body, true);
    }
}
