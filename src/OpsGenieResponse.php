<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */

namespace JTL\OpsGenie\Client;

abstract class OpsGenieResponse
{

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $body;

    /**
     * OpsGenieResponse constructor.
     * @param int $statusCode
     * @param array $body
     */
    public function __construct(int $statusCode, array $body)
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getFromBody(string $key)
    {
        return $this->body[$key] ?? null;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->getFromBody('message');
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->getFromBody('requestId') ?? 'unknown';
    }

    /**
     * @return bool
     */
    abstract public function isSuccessful(): bool;
}
