<?php

namespace Omnipay\SportsPay;

use Omnipay\Tests\TestCase;

class GatewayTest extends TestCase
{
    protected Gateway $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testGetName(): void
    {
        $this->assertSame('SportsPay', $this->gateway->getName());
    }

    public function testAuthorize(): void
    {
        $request = $this->gateway->authorize();

        $this->assertInstanceOf(Message\AuthorizeRequest::class, $request);
    }

    public function testGetApiKey(): void
    {
        $request = $this->gateway->getApiKey();

        $this->assertInstanceOf(Message\GetApiKeyRequest::class, $request);
    }

    public function testFetchTransaction(): void
    {
        $request = $this->gateway->fetchTransaction();

        $this->assertInstanceOf(Message\FetchTransactionRequest::class, $request);
    }

    public function testPurchase(): void
    {
        $request = $this->gateway->purchase();

        $this->assertInstanceOf(Message\PurchaseRequest::class, $request);
    }

    public function testRefund(): void
    {
        $request = $this->gateway->refund();

        $this->assertInstanceOf(Message\RefundRequest::class, $request);
    }

    public function testVoid(): void
    {
        $request = $this->gateway->void();

        $this->assertInstanceOf(Message\VoidRequest::class, $request);
    }
}
