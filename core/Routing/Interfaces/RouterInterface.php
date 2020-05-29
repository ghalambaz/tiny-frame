<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Interfaces\RouteCollectionInterface;
use Core\Routing\Interfaces\RouteInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{
    public function getRouteCollection() : RouteCollectionInterface;
    public function matchRequest(ServerRequestInterface $request) : RouteInterface;
    public function call(Route $route,ContainerInterface $container) ;

}