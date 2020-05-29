<?php
declare(strict_types=1);

namespace Core\Http\Message;

use Core\Exception\MethodNotImplementedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\MessageInterface;

class MessageTest extends TestCase
{

    protected Message $message;
    protected function setUp(): void
    {
        $this->message = new Message();
    }

    public function testInstanceOfMessageInterface()
    {
        $this->assertInstanceOf(MessageInterface::class,$this->message);
    }
    public function testGetHeaderLine()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->getHeaderLine('test');
    }

    public function testWithAddedHeader()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->withAddedHeader('test','value');

    }
    public function testHasHeader()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->hasHeader('test');
    }
    public function testGetBody()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->getBody();
    }

    public function testWithProtocolVersion()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->withProtocolVersion('test');

    }

    public function testGetHeaders()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->getHeaders();
    }


    public function testWithoutHeader()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->withoutHeader('test');
    }

    public function testGetProtocolVersion()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->getProtocolVersion();
    }

    public function testGetHeader()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->getHeader('test');
    }

    public function testWithHeader()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->message->withHeader('test','test');
    }
}
