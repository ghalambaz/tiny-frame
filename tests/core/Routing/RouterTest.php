<?php
declare(strict_types=1);

namespace Core\Routing;

use Core\Container\Container;
use Core\ResourceLoader\YamlLoader;
use Core\Routing\Exception\InvalidRouteException;
use Core\Routing\Interfaces\RouterInterface;
use Core\Routing\Objects\Route;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    protected Router $router;

    protected function setUp(): void
    {
        $this->router = new Router('test',new RouteLoader(new YamlLoader()),new RouteMatcher());
    }

    public function testInstanceOfRouterInterface()
    {
        $this->assertInstanceOf(RouterInterface::class,$this->router);
    }

    public function testCallSuccess()
    {
        $routeMock = $this->createMock(Route::class);
        $routeMock->expects($this->once())
            ->method('getCallback')
            ->will($this->returnValue('Tests\testFiles\ValidTestController:test'));
        $this->assertEquals('valid', $this->router->call($routeMock,new Container([])));
    }
    public function testCallFailed()
    {
        $this->expectException(InvalidRouteException::class);
        $routeMock = $this->createMock(Route::class);
        $routeMock->expects($this->once())
            ->method('getCallback')
            ->will($this->returnValue('Tests\testFiles\InvalidTestController:test'));
        $this->router->call($routeMock,new Container([]));
    }
    public function testCallFailedInvalidCallbackNotFound()
    {
        $this->expectException(InvalidRouteException::class);
        $routeMock = $this->createMock(Route::class);
        $routeMock->expects($this->once())
            ->method('getCallback')
            ->will($this->returnValue('Tests\testFiles\InvalidTestController'));
        $this->router->call($routeMock,new Container([]));
    }
    public function testCallFailedInvalidCallbackFunctionNotFound()
    {
        $this->expectException(InvalidRouteException::class);
        $routeMock = $this->createMock(Route::class);
        $routeMock->expects($this->once())
            ->method('getCallback')
            ->will($this->returnValue('Tests\testFiles\InvalidTestController:CallbackFunctionNotFound'));
        $this->router->call($routeMock,new Container([]));
    }



}
