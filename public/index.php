<?php
require __DIR__.'/../vendor/autoload.php';

define('APPLICATION_PATH', realpath(dirname(__FILE__).'/..'));

use Core\Container\Container;
use Core\Exception\LogicalException;
use Core\Http\Factory\ServerRequestFactory;
use Core\Kernel\Application;



try {
    $app = Application::getInstance();
    $app->init(new Container(),new ServerRequestFactory());
    $app->run();
} catch (LogicalException $e) {
    echo $e->getMessage();
}

