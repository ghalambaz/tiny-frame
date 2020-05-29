<?php
declare(strict_types=1);

namespace Core\Routing;

use Core\ResourceLoader\Exception\DataNotLoadedException;
use Core\ResourceLoader\ResourceLoaderInterface;
use Core\ResourceLoader\YamlLoader;
use PHPUnit\Framework\TestCase;

class RouteLoaderTest extends TestCase
{

    protected RouteLoader $loader;
    const BASE_TEST_FILES = 'tests/testFiles/';

    protected function setUp(): void
    {
        $this->loader = new RouteLoader(new YamlLoader());
    }

    public function testLoad()
    {
        $data = $this->loader->load(self::BASE_TEST_FILES.'routing.yml');
        $this->assertArrayHasKey('blog',$data);
    }
    public function testLoadInvalidData()
    {
        $this->expectException(DataNotLoadedException::class);
        $this->loader->load(self::BASE_TEST_FILES.'file.test.yml');
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(ResourceLoaderInterface::class,$this->loader);
    }
}
