<?php
declare(strict_types=1);

namespace Core\Routing\Interface;


use Core\Routing\RouteCollectionInterface;

interface RouteCollectionBuilderInterface
{
    public function build():RouteCollectionInterface;
}