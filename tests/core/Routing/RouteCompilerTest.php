<?php
declare(strict_types=1);

namespace Core\Routing;

use Core\ResourceLoader\YamlLoader;
use PHPUnit\Framework\TestCase;

class RouteCompilerTest extends TestCase
{

    public function testCompile()
    {
        $loader= new RouteLoader(new YamlLoader());
        $routeData = $loader->load('tests/testFiles/routing.yml');
        $routeCollection = (new RouteCollectionBuilder)->build($routeData);
        $this->assertEquals('`^/blog/(?<year>\d+)/(?<month>\w+)/(?<day>.+?)$`',RouteCompiler::compile($routeCollection->getRoute('blog')));
        $this->assertEquals('`^/$`',RouteCompiler::compile($routeCollection->getRoute('default')));
    }
}
