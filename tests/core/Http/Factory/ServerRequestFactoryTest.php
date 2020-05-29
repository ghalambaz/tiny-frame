<?php
declare(strict_types=1);

namespace Core\Http\Factory;

use Core\Exception\MethodNotImplementedException;
use Core\Http\Message\ServerRequest;
use Core\Http\Message\Uri;
use PHPUnit\Framework\TestCase;

class ServerRequestFactoryTest extends TestCase
{

    public function testCreateFromGlobals()
    {
        $serverRequest  = (new ServerRequestFactory())->createFromGlobals();
        $this->assertInstanceOf(ServerRequest::class,$serverRequest);
    }
    public function testCreateServerRequest()
    {
        $this->expectException(MethodNotImplementedException::class);
        (new ServerRequestFactory())->createServerRequest('GET',Uri::create("http://ali-ghalambaz.ir"),[]);
    }
}
