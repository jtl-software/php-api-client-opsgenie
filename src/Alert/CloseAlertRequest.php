<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */
declare(strict_types=1);


namespace JTL\OpsGenie\Client\Alert;

use JTL\OpsGenie\Client\OpsGenieRequest;

class CloseAlertRequest implements OpsGenieRequest
{

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $note;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getHttpMethod(): string
    {
        return "POST";
    }

    public function getUrl(): string
    {
        $_ = urlencode($this->alias);
        return "alerts/{$_}/close?identifierType=alias";
    }

    public function getBody(): array
    {
        $request = [];
        if (!empty($this->user)) {
            $request['user'] = $this->user;
        }

        if (!empty($this->source)) {
            $request['source'] = $this->source;
        }

        if (!empty($this->note)) {
            $request['note'] = $this->note;
        }

        return $request;
    }
}
