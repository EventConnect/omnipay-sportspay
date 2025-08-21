<?php

namespace Omnipay\SportsPay\Message;

class GetApiKeyResponse extends Response
{
    public function getApiKey(): string
    {
        return $this->data['APIKEY'];
    }

    public function getHost(): string
    {
        return $this->data['HOST'];
    }
}
