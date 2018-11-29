<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/21/18
 */

namespace JTL\OpsGenie\Client;

interface OpsGenieRequest
{
    public function getHttpMethod(): string;

    public function getUrl(): string;

    public function getBody(): array;
}
