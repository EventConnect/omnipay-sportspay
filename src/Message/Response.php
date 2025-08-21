<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        return $this->getCode() === '0000';
    }

    /**
     * @inheritDoc
     */
    public function getCode(): ?string
    {
        return $this->data['CODE'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): ?string
    {
        return $this->data['TEXT'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['GATEREF'] ?? null;
    }
}
