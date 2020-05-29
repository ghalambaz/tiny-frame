<?php
declare(strict_types=1);

namespace Core\Container;

use Core\Container\Exception\InvalidServiceException;
use Core\Container\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ContainerTest extends TestCase
{

    public function testContainerHas()
    {
        $container = new Container([
            'data'=> function() {}
        ]);
        $this->assertTrue($container->has('data'));
    }
    public function testRegisterService()
    {
        $container = new Container([]);
        $container->registerService('data',function() {return 'valid';});
        $this->assertEquals('valid',$container->get('data'));
    }
    public function testContainerGet()
    {
        $container = new Container([
            'data'=> function() {
             return 'valid';
            }
        ]);
        $this->assertEquals('valid',$container->get('data'));
    }
    public function testContainerGetMultipleCall()
    {
        $container = new Container([
            'data'=> function() {
                return 'valid';
            }
        ]);
        $container->get('data');
        $this->assertEquals('valid',$container->get('data'));
    }
    public function testInstantiateService()
    {
        $container = new Container([
            'data'=> function() {
                return 'valid';
            }
        ]);
        $class= new ReflectionClass($container);
        $method = $class->getMethod('instantiateService');
        $method->setAccessible(true);
        self::assertEquals('valid',$method->invoke($container,'data'));
    }
    public function testHasNot()
    {
        $this->expectException(NotFoundException::class);
        $container = new Container([]);
        $container->get('data');
    }
    public function testInstantiateServiceException()
    {
        $this->expectException(InvalidServiceException::class);

        $container = new Container([
            'data'=> 'data'
        ]);
        $class= new ReflectionClass($container);
        $method = $class->getMethod('instantiateService');
        $method->setAccessible(true);
        $method->invoke($container,'data');
    }

}
