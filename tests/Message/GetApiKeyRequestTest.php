<?php

namespace Omnipay\SportsPay\Message;

use Omnipay\Tests\TestCase;

class GetApiKeyRequestTest extends TestCase
{
    protected GetApiKeyRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new GetApiKeyRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'terminalId' => 'TERM1',
            'password' => 'PASSWORD',
        ]);
    }

    public function testSendSuccess(): void
    {
        $this->request->setAmount('100.00');
        $this->setMockHttpResponse('GetApiKeySuccess.txt');

        /** @var GetApiKeyResponse $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('@907E1057701B9209DDE4874B29B1CFA6761DFA215286A75087411CAD1ABC3D23', $response->getApiKey());
        $this->assertSame('https://testgate.interpaypos.com/', $response->getHost());
    }

//    public function testSendFailure(): void
//    {
//        $this->request->setAmount('100.00');
//        $this->setMockHttpResponse('GetApiKeyFailure.txt');
//
//        /** @var GetApiKeyResponse $response */
//        $response = $this->request->send();
//
//        $this->assertFalse($response->isSuccessful());
//        $this->assertSame('INVALID REQUEST', $response->getMessage());
//    }
}
