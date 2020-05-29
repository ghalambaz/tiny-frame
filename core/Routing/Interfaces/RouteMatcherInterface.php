<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Interfaces\RouteCollectionInterface;
use Core\Routing\Interfaces\RouteInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RouteMatcherInterface
{
    public function matchRequest(ServerRequestInterface $serverRequest,RouteCollectionInterface $routeCollection) : RouteInterface;
}