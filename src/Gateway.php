<?php

namespace Omnipay\SportsPay;

use Omnipay\SportsPay\Message\AuthorizeRequest;
use Omnipay\SportsPay\Message\FetchTransactionRequest;
use Omnipay\SportsPay\Message\GetApiKeyRequest;
use Omnipay\SportsPay\Message\PurchaseRequest;
use Omnipay\SportsPay\Message\RefundRequest;
use Omnipay\SportsPay\Message\VoidRequest;

/**
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends \Omnipay\Common\AbstractGateway
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'SportsPay';
    }

    public function getPassword(): ?string
    {
        return $this->getParameter('password');
    }

    public function setPassword($value): self
    {
        return $this->setParameter('password', $value);
    }

    public function getTerminalId(): ?string
    {
        return $this->getParameter('terminalId');
    }

    public function setTerminalId($value): self
    {
        return $this->setParameter('terminalId', $value);
    }

    public function authorize($options = []): AuthorizeRequest
    {
        /** @var AuthorizeRequest */
        return $this->createRequest(AuthorizeRequest::class, $options);
    }

    public function getApiKey($options = []): GetApiKeyRequest
    {
        /** @var GetApiKeyRequest */
        return $this->createRequest(GetApiKeyRequest::class, $options);
    }

    public function fetchTransaction($options = []): FetchTransactionRequest
    {
        /** @var FetchTransactionRequest */
        return $this->createRequest(FetchTransactionRequest::class, $options);
    }

    public function purchase($options = []): PurchaseRequest
    {
        /** @var PurchaseRequest */
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function refund($options = []): RefundRequest
    {
        /** @var RefundRequest */
        return $this->createRequest(RefundRequest::class, $options);
    }

    public function void($options = []): VoidRequest
    {
        /** @var VoidRequest */
        return $this->createRequest(VoidRequest::class, $options);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}
