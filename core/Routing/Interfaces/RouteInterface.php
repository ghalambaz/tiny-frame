<?php
declare(strict_types=1);

namespace Core\Routing\Interface;


interface RouteInterface
{
    public function setName(string $name) : RouteInterface;
    public function getName() : string ;
    public function setPath(string $path) : RouteInterface;
    public function getPath() : string ;
    public function setCallback(callable $callback) : RouteInterface;
    public function getCallback() : callable ;
    public function setParameter(RouteParameterInterface $parameter);
    public function getParameter(string $name): RouteParameterInterface;

}