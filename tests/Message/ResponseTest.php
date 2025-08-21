<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testPurchaseSuccess(): void
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseRequestSuccess.txt');
        $response = new Response($this->getMockRequest(), json_decode($httpResponse->getBody(), true));

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('z0o9o0vk4oqamp', $response->getTransactionReference());
        $this->assertSame('T43225 $1.00', $response->getMessage());
    }

    public function testPurchaseFailure(): void
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseRequestFailure.txt');
        $response = new Response($this->getMockRequest(), json_decode($httpResponse->getBody(), true));

        $this->assertFalse($response->isSuccessful());
    }
}
