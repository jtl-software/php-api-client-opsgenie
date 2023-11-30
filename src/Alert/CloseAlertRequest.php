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
    private ?string $user = null;

    private ?string $source = null;

    private ?string $note = null;

    public function __construct(private readonly string $alias)
    {
    }

    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

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
        if ($this->user !== null && $this->user !== '') {
            $request['user'] = $this->user;
        }

        if ($this->source !== null && $this->source !== '') {
            $request['source'] = $this->source;
        }

        if ($this->note !== null && $this->note !== '') {
            $request['note'] = $this->note;
        }

        return $request;
    }
}
