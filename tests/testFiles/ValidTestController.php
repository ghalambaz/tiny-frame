<?php
declare(strict_types=1);

namespace Tests\testFiles;


class ValidTestController extends \Core\Kernel\ControllerAbstract
{
    public function test()
    {
        return 'valid';
    }
}