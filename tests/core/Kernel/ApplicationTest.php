<?php
declare(strict_types=1);

namespace Core\Kernel;

use Core\Container\Container;
use Core\Exception\LogicalException;
use Core\Http\Factory\ServerRequestFactory;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{

    public function testGetInstance()
    {
        $app = Application::getInstance();
        self::assertInstanceOf(Application::class,$app);
    }
    public function testApplicationIsSingleton()
    {
        $app = Application::getInstance();
        $anotherApp = Application::getInstance();
        $this->assertSame($app,$anotherApp);
    }

    public function testRun()
    {
        $this->expectOutputString('Hello Friends');
        $app = Application::getInstance();
        $app->init(new Container(),new ServerRequestFactory());
        $app->run();

    }
    public function testRunContainerNotContainService()
    {
        $this->expectException(LogicalException::class);
        $app = Application::getInstance();
        $mockContainer = $routeMock = $this->createMock(Container::class);
        $routeMock->expects($this->any())
            ->method('has')
            ->will($this->returnValue(false));
        $app->init($mockContainer,new ServerRequestFactory());
        $app->run();

    }
    public function testRunWithNoContainer()
    {
        $this->expectException(LogicalException::class);
        $app = Application::getInstance();
        $app->run();

    }


    public function ApplicationClass() {

        return new class() extends Application {
            public function __construct()
            {
                parent::__construct();
            }
        };
    }
}
