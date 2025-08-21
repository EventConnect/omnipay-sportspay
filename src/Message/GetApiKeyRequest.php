<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class GetApiKeyRequest extends AbstractRequest
{
    public const TYPE = 'Z';

    public const SUBTYPE = 'TA';

    /**
     * @inheritDoc
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount');

        return [
            ...parent::getData(),
            'SUBTYPE' => static::SUBTYPE,
            'AMT' => $this->getAmount(),
        ];
    }

    protected function createResponse($data): Response
    {
        return $this->response = new GetApiKeyResponse($this, $data);
    }
}
