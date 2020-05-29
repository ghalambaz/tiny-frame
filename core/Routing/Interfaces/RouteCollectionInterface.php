<?php
declare(strict_types=1);

namespace Core\Routing;


use ArrayAccess;

interface RouteCollectionInterface extends ArrayAccess
{
    public function addRoute(string $name,Route $route);
    public function getRoutes();

}