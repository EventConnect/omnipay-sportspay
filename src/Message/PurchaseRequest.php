<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    public const TYPE = 'S';

    /**
     * @inheritDoc
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'transactionId');

        $data = [
            'AMT' => $this->getAmount(),
            'REF' => (string) $this->getTransactionId(),
        ];

        if ($token = $this->getToken()) {
            $data['TOKEN'] = $token;
        } else if ($card = $this->getCard()) {
            $data['CARD'] = $card->getNumber();
            $data['EXP'] = $card->getExpiryDate('my');
            $data['CVV2'] = $card->getCvv();
        }

        return array_merge(parent::getData(), $data);
    }
}
