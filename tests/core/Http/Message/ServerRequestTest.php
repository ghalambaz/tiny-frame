<?php
declare(strict_types=1);

namespace Core\Http\Message;

use Core\Exception\MethodNotImplementedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class ServerRequestTest extends TestCase
{
    protected ServerRequest $serverRequest;
    protected function setUp(): void
    {
        $this->serverRequest = new ServerRequest(Uri::create("http://ali-ghalambaz.ir"),[],[],'GET');
    }

    public function testInstanceOfServerRequestInterface()
    {
        $this->assertInstanceOf(ServerRequestInterface::class,$this->serverRequest);
    }

    public function testWithParsedBody()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->withParsedBody([]);
    }


    public function testGetParsedBody()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->getParsedBody();
    }

    public function testGetServerParams()
    {

        $this->assertIsArray($this->serverRequest->getServerParams());
    }

    public function testGetAttribute()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->getAttribute('name');
    }

    public function testWithoutAttribute()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->withoutAttribute('name');
    }

    public function testWithQueryParams()
    {
        $this->assertInstanceOf(ServerRequestInterface::class,$this->serverRequest->withQueryParams([]));
    }

    public function testWithCookieParams()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->withCookieParams([]);
    }


    public function testWithAttribute()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->withAttribute('name','value');
    }

    public function testGetQueryParams()
    {

        $this->assertIsArray($this->serverRequest->getQueryParams());
    }

    public function testGetUploadedFiles()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->getUploadedFiles();
    }

    public function testGetAttributes()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->getAttributes();
    }

    public function testWithUploadedFiles()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->withUploadedFiles([]);
    }

    public function testGetCookieParams()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->serverRequest->getCookieParams();
    }
}
