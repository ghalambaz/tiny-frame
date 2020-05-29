<?php
declare(strict_types=1);

namespace Core\Kernel;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateEngineTest extends TestCase
{

    const VIEW_ADDRESS = 'tests/testFiles';
    protected $templateEngine;

    protected function setUp() : void
    {
        $loader = new FilesystemLoader(self::VIEW_ADDRESS);
        $twig =  new Environment($loader);
        $this->templateEngine = new TemplateEngine($twig);
    }

    public function testRender()
    {
        $content = $this->templateEngine->render('file.test.html.twig',['var'=>'ali']);
        $this->assertEquals('ali',$content);
    }

}
