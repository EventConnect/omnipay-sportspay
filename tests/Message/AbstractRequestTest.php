<?php

namespace Omnipay\SportsPay\Message;

use Mockery;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    protected AbstractRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = Mockery::mock(AbstractRequest::class)->makePartial();
        $this->request->initialize([
            'terminalId' => 'TERM1',
            'password' => 'PASSWORD',
        ]);
    }

    public function testEndpoint(): void
    {
        $this->assertSame('https://paynow.interpaypos.com/api', $this->request->getEndpoint());

        $this->request->setTestMode(true);
        $this->assertSame('https://testgate.interpaypos.com/api', $this->request->getEndpoint());
    }

    public function testHost(): void
    {
        $this->request->setHost('https://svra.interpaypos.com:1443');
        $this->assertSame('https://svra.interpaypos.com:1443', $this->request->getHost());
        $this->assertSame('https://svra.interpaypos.com:1443/api', $this->request->getEndpoint());
    }

}
