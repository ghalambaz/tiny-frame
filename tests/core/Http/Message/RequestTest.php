<?php
declare(strict_types=1);

namespace Core\Http\Message;

use Core\Exception\MethodNotImplementedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestTest extends TestCase
{
    protected Request $request;
    protected function setUp(): void
    {
        $this->request = new Request('GET',Uri::create('http://ali-ghalambaz.ir'));
    }

    public function testInstanceOfRequestInterface()
    {
        $this->assertInstanceOf(RequestInterface::class,$this->request);
    }
    public function testWithUri()
    {
        $this->request->withUri(Uri::create("http://google.com"));
        $this->assertInstanceOf(RequestInterface::class,$this->request);
    }

    public function testGetRequestTarget()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->request->getRequestTarget();
    }

    public function testGetMethod()
    {
        $this->assertEquals('GET',$this->request->getMethod());
    }

    public function testGetUri()
    {
        $this->assertInstanceOf(UriInterface::class,$this->request->getUri());
    }

    public function testWithRequestTarget()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->request->withRequestTarget(null);
    }

    public function testWithMethod()
    {
        $this->assertInstanceOf(RequestInterface::class,$this->request->withMethod('POST'));
    }
}
