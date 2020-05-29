<?php
declare(strict_types=1);

namespace Core\Http\Message;

use Core\Exception\MethodNotImplementedException;
use Core\Http\Message\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;

class UriTest extends TestCase
{
    protected Uri $uri;
    protected function setUp(): void
    {
        $this->uri = Uri::create('http://ali-ghalambaz.ir:8989/withPath?and=query#evenFragment');
    }

    public function urlProvider()
    {
        return [
            ['http://ali-ghalambaz.ir'],
            ['https://ali-ghalambaz.ir/withPath'],
            ['http://ali-ghalambaz.ir/withPath?and=query'],
            ['http://ali-ghalambaz.ir:8989/withPath?and=query'],
            ['http://ali-ghalambaz.ir:8989/withPath?and=query#evenFragment'],
            ['https://ali-ghalambaz.ir?and=query'],
            ['http://ali-ghalambaz.ir#evenFragment'],
            ['https://ali-ghalambaz.ir/withPath#evenFragment'],
        ];
    }
    public function invalidUrlProvider()
    {
        return [
            [''],
            ['text'],
            ['https://'],
            ['http://?asdas'],
            ['ftp://ali-ghalambaz.ir'],
            ['https://ali-ghalambaz.ir:99999']
            //['http://ali-ghalambaz']  //this type of uri works in local networks
        ];
    }

    /**
     * @dataProvider urlProvider
     */
    public function testCreateAndToString($data)
    {
        $uri = Uri::create($data);
        $this->assertEquals($data,$uri);
    }
    /**
     * @dataProvider invalidUrlProvider
     */
    public function testInvalidUri($data)
    {
        $this->expectException(InvalidArgumentException::class);
        $uri = Uri::create($data);
    }

    public function testGetScheme()
    {
        $this->assertEquals('http',$this->uri->getScheme());
    }
    public function testWithScheme()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withScheme('https'));
    }
    public function testWithSameScheme()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withScheme('http'));
    }
    public function testWithHost()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withHost('test.com'));
    }
    public function testWithPort()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withPort(1000));
    }
    public function testWithPath()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withPath('/newPath'));
    }
    public function testWithQuery()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withQuery('que=ry'));
    }
    public function testWithFragment()
    {
        $this->assertInstanceOf(UriInterface::class,$this->uri->withFragment('fragment'));
    }
    public function testWithUserInfo()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->uri->withUserInfo('user','pass');

    }
    public function testGetAuthority()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->uri->getAuthority();
    }

    public function testGetFragment()
    {
        $this->assertEquals('evenFragment',$this->uri->getFragment());
    }
    public function testGetPort()
    {
        $this->assertEquals(8989,$this->uri->getPort());
    }

    public function testGetQuery()
    {
        $this->assertEquals('and=query',$this->uri->getQuery());
    }

    public function testGetPath()
    {
        $this->assertEquals('/withPath',$this->uri->getPath());
    }

    public function testGetHost()
    {
        $this->assertEquals('ali-ghalambaz.ir',$this->uri->getHost());
    }

    public function testNotImplementedFunctionGetUserInfo()
    {
        $this->expectException(MethodNotImplementedException::class);
        $this->uri->getUserInfo();
    }

}
