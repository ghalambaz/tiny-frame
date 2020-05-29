<?php
declare(strict_types=1);

namespace Core\Routing;

use Core\ResourceLoader\YamlLoader;
use Core\Routing\Exception\InvalidRouteException;
use Core\Routing\Interfaces\RouteCollectionBuilderInterface;
use Core\Routing\Interfaces\RouteCollectionInterface;
use PHPUnit\Framework\TestCase;

class RouteCollectionBuilderTest extends TestCase
{

    protected RouteCollectionBuilder $routeCollectionBuilder;
    protected RouteLoader $routeLoader;
    const BASE_TEST_FILES = 'tests/testFiles/';
    protected function setUp(): void
    {
        $this->routeCollectionBuilder = new RouteCollectionBuilder();
        $this->routeLoader = new RouteLoader(new YamlLoader());

    }
    public function testInstanceofRouteCollectionBuilderInterface()
    {
        $this->assertInstanceOf(RouteCollectionBuilderInterface::class,$this->routeCollectionBuilder);
    }

    public function testBuild()
    {
        $routeCollection = $this->routeCollectionBuilder->build($this->routeLoader->load(self::BASE_TEST_FILES.'routing.yml'));
        $this->assertInstanceOf(RouteCollectionInterface::class,$routeCollection);
    }
    public function testBuildFailed()
    {
        $this->expectException(InvalidRouteException::class);
        $this->routeCollectionBuilder->build($this->routeLoader->load(self::BASE_TEST_FILES.'invalid_routing.yml'));
    }
}
