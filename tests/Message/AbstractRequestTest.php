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

    public function testPlatformFee(): void
    {
        $this->request->setPlatformFee('10.00');
        $data = $this->request->getData();

        $this->assertSame('10.00', $data['PLATFEE']);
    }
}

//test('get data', function () {
//    $this->request->getData();
//
//    expect($this->request->getTerminalId())->toBe('TERM1')
//        ->and($this->request->getPassword())->toBe('PASSWORD');
//});
