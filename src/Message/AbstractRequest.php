<?php

namespace Omnipay\SportsPay\Message;

use JsonException;
use Omnipay\Common\Exception\InvalidRequestException;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected string $liveEndpoint = 'https://paynow.interpaypos.com';
    protected string $testEndpoint = 'https://testgate.interpaypos.com';
    protected string $path = 'api';

    public function getHost(): ?string
    {
        return $this->getParameter('host');
    }

    public function setHost($value): self
    {
        return $this->setParameter('host', $value);
    }

    public function getPassword(): ?string
    {
        return $this->getParameter('password');
    }

    public function setPassword($value): self
    {
        return $this->setParameter('password', $value);
    }

    public function setPlatformFee($value): self
    {
        return $this->setParameter('platformFee', $value);
    }

    public function getPlatformFee(): ?string
    {
        return $this->getParameter('platformFee');
    }

    public function getTerminalId(): ?string
    {
        return $this->getParameter('terminalId');
    }

    public function setTerminalId($value): self
    {
        return $this->setParameter('terminalId', $value);
    }

    /**
     * @inheritDoc
     * @throws JsonException
     */
    public function sendData($data): Response
    {
        $requestBody = json_encode($data, JSON_THROW_ON_ERROR);
        $response = $this->httpClient->request('POST', $this->getEndpoint(), [], $requestBody);

        $responseBody = json_decode($response->getBody(), true, 2, JSON_THROW_ON_ERROR);
        return $this->createResponse($responseBody);
    }

    /**
     * @inheritDoc
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('terminalId', 'password');

        $data = [
            'TERMID' => $this->getTerminalId(),
            'PASS' => $this->getPassword(),
        ];

        if (defined('static::TYPE')) {
            $data['TYPE'] = static::TYPE;
        }

        if ($platformFee = $this->getPlatformFee()) {
            $data['PLATFEE'] = $platformFee;
        }

        return $data;
    }

    public function getEndpoint(): string
    {
        if ($endpoint = $this->getHost()) {
            return "$endpoint/$this->path";
        }

        if ($this->getTestMode()) {
            return "$this->testEndpoint/$this->path";
        }

        return "$this->liveEndpoint/$this->path";
    }

    protected function createResponse($data): Response
    {
        return $this->response = new Response($this, $data);
    }
}
