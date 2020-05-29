<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RouterInterface
 * @package Core\Routing\Interfaces
 */
interface RouterInterface
{
    /**
     * @return RouteCollectionInterface
     */
    public function getRouteCollection(): RouteCollectionInterface;

    /**
     * @param ServerRequestInterface $request
     * @return RouteInterface
     */
    public function matchRequest(ServerRequestInterface $request): RouteInterface;

    /**
     * @param RouteInterface $route
     * @param ContainerInterface $container
     * @return mixed
     */
    public function call(RouteInterface $route, ContainerInterface $container);

}