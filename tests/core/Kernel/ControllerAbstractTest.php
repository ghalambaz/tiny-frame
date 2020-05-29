<?php
declare(strict_types=1);

namespace Core\Kernel;

use Core\Container\Container;
use Core\Container\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerAbstractTest extends TestCase
{
    const VIEW_ADDRESS = 'tests/testFiles';
    protected $classFromAbstract;

    protected function setUp(): void
    {
        $this->classFromAbstract = new class(new Container()) extends ControllerAbstract{
            public function returnThis()
            {
                return $this;
            }
        };
    }

    public function testGetContainer()
    {
        $this->assertInstanceOf(Container::class,$this->classFromAbstract->getContainer());
    }
    public function testSetContainer()
    {
        $this->assertInstanceOf(ControllerAbstract::class,$this->classFromAbstract->setContainer(new Container()));
    }


    public function testRenderNotFoundException()
    {
        $this->expectException(NotFoundException::class);
        $content = $this->classFromAbstract->render('file.test.html.twig',['var'=>'ali']);
        $this->assertEquals('ali',$content);
    }
    public function testRender()
    {
        $container = $this->classFromAbstract->getContainer();
        $container->registerService('template.engine',function() {
        $loader = new FilesystemLoader(self::VIEW_ADDRESS);
        $twig =  new Environment($loader);
        return new TemplateEngine($twig);});

        $content = $this->classFromAbstract->render('file.test.html.twig',['var'=>'ali']);
        $this->assertEquals('ali',$content);
    }

    public function testHas()
    {
        $container = $this->classFromAbstract->getContainer();
        $container->registerService('data',function (){});
        $this->assertTrue($this->classFromAbstract->has('data'));
    }

    public function testGet()
    {
        $container = $this->classFromAbstract->getContainer();
        $container->registerService('data',function (){ return 'valid';});
        $this->assertEquals('valid',$this->classFromAbstract->get('data'));
    }
}
