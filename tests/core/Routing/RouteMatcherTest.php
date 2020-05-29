<?php
declare(strict_types=1);

namespace Core\Routing;

use Core\Http\Message\ServerRequest;
use Core\Http\Message\Uri;
use Core\ResourceLoader\YamlLoader;
use Core\Routing\Exception\RouteNotFoundException;
use Core\Routing\Interfaces\RouteInterface;
use PHPUnit\Framework\TestCase;

class RouteMatcherTest extends TestCase
{

    protected RouteMatcher $routeMatcher;
    protected function setUp(): void
    {
        $this->routeMatcher = new RouteMatcher();
    }

    public function testMatchRequestFound()
    {
        $loader= new RouteLoader(new YamlLoader());
        $routeData = $loader->load('tests/testFiles/routing.yml');
        $routeCollection = (new RouteCollectionBuilder)->build($routeData);

        $uriMock = $this->createMock(Uri::class);
        $uriMock->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/blog/123/abc/cde'));

        $serverMock = $this->createMock(ServerRequest::class);
        $serverMock ->expects($this->once())
            ->method('getUri')
            ->will($this->returnValue($uriMock));

        $this->assertInstanceOf(RouteInterface::class,$this->routeMatcher->matchRequest($serverMock,$routeCollection));

    }

    public function testMatchRequestNotFound()
    {
        $this->expectException(RouteNotFoundException::class);
        $loader= new RouteLoader(new YamlLoader());
        $routeData = $loader->load('tests/testFiles/routing.yml');
        $routeCollection = (new RouteCollectionBuilder)->build($routeData);

        $uriMock = $this->createMock(Uri::class);
        $uriMock->expects($this->once())
            ->method('getPath')
            ->will($this->returnValue('/blog/123'));

        $serverMock = $this->createMock(ServerRequest::class);
        $serverMock ->expects($this->once())
            ->method('getUri')
            ->will($this->returnValue($uriMock));

        $this->routeMatcher->matchRequest($serverMock,$routeCollection);

    }

}
