<?php
declare(strict_types=1);

namespace Core\Kernel;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewManagerTest extends TestCase
{

    protected ViewManager $viewManager ;

    protected function setUp(): void
    {
       $this->viewManager =  new ViewManager();
    }

    public function testRender()
    {
        $this->expectOutputString('ali');
        $this->viewManager->render('ali');
    }
    public function testRenderNotFound()
    {
        $this->expectOutputString('404 Not Found');
        $this->viewManager->renderPageNotFound();
    }
}
