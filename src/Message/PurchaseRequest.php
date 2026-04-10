<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    public const TYPE = 'S';

    public function getInvoiceNumber(): ?string
    {
        return $this->getParameter('invoiceNumber');
    }

    public function setInvoiceNumber($value): self
    {
        return $this->setParameter('invoiceNumber', $value);
    }

    public function getPlatformFee(): ?string
    {
        return $this->getParameter('platformFee');
    }

    public function setPlatformFee($value): self
    {
        return $this->setParameter('platformFee', $value);
    }

    public function getPlatformCharge(): ?string
    {
        return $this->getParameter('platformCharge');
    }

    public function setPlatformCharge($value): self
    {
        return $this->setParameter('platformCharge', $value);
    }

    public function getUserFee(): ?string
    {
        return $this->getParameter('userFee');
    }

    public function setUserFee($value): self
    {
        return $this->setParameter('userFee', $value);
    }

    /**
     * @inheritDoc
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'transactionId');

        $data = [
            'AMT' => $this->getAmount(),
            'REF' => $this->getTransactionId(),
        ];

        if ($token = $this->getToken()) {
            $data['TOKEN'] = $token;
        } else if ($card = $this->getCard()) {
            $data['CARD'] = $card->getNumber();
            $data['EXP'] = $card->getExpiryDate('my');
            $data['CVV2'] = $card->getCvv();

            if ($name = $card->getName()) {
                $data['CUSTNAME'] = $name;
            }

            if ($email = $card->getEmail()) {
                $data['CUSTEMAIL'] = $email;
            }
        }

        if ($invoice = $this->getInvoiceNumber()) {
            $data['INV'] = $invoice;
        }

        if ($description = $this->getDescription()) {
            $data['DESC'] = $description;
        }

        if ($platformFee = $this->getPlatformFee()) {
            $data['PLATFEE'] = $platformFee;
        }

        if ($platformCharge = $this->getPlatformCharge()) {
            $data['PLATCHRG'] = $platformCharge;
        }

        if ($userFee = $this->getUserFee()) {
            $data['USERFEE'] = $userFee;
        }

        return array_merge(parent::getData(), $data);
    }
}
