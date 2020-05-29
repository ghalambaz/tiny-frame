<?php
declare(strict_types=1);

namespace App\controllers;


use Core\Kernel\ControllerAbstract;

class Main extends ControllerAbstract
{

    public function index()
    {
        return $this->render('hello.html.twig',['message'=>'Hello Friends']);
    }
}