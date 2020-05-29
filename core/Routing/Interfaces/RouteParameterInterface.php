<?php
declare(strict_types=1);

namespace Core\Routing\Interface;


interface RouteParameterInterface
{
    public function setName(string $name) : RouteParameterInterface ;
    public function getName() : string ;
    public function setPattern(string $pattern) : RouteParameterInterface ;
    public function getPattern() : string ;
    public function setDefaultValue($defaultValue): RouteParameterInterface;
    public function getDefaultValue();
}