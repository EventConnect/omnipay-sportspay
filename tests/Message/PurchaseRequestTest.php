<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    protected PurchaseRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'terminalId' => 'TERM1',
            'password' => 'PASSWORD',
        ]);
    }

    public function testSendSuccess(): void
    {
        $this->request->setAmount('100.00');
        $this->request->setToken('TEST');
        $this->request->setTransactionReference('1234567890');
        $this->setMockHttpResponse('PurchaseRequestSuccess.txt');

        /** @var Response $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('z0o9o0vk4oqamp', $response->getTransactionReference());
    }

    public function testSendFailure(): void
    {
        $this->request->setAmount('100.00');
        $this->request->setToken('TEST');
        $this->request->setTransactionReference('1234567890');
        $this->setMockHttpResponse('PurchaseRequestFailure.txt');

        /** @var Response $response */
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('INVALID TOKEN', $response->getMessage());
    }
}
