<?php
declare(strict_types=1);

namespace Core\ResourceLoader;

use Core\ResourceLoader\Exception\ParseException;
use PHPUnit\Framework\TestCase;

class YamlLoaderTest extends TestCase
{
    protected YamlLoader $loader;
    public function setUp(): void
    {
        $this->loader= new YamlLoader();
    }

    public function testLoad()
    {
        $data = $this->loader->load('tests/testFiles/file.test.yml');
        $this->assertArrayHasKey('two',$data);
    }
    public function testLoadWronAddressParseException()
    {
        $this->expectException(ParseException::class);
        $this->loader->load('/tests/testFiles/file.test.yml');
    }
    public function testLoadParseException()
    {
        $this->expectException(ParseException::class);
        $this->loader->load('tests/testFiles/file.test.invalid.yml');
    }
}
