<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RouteMatcherInterface
 * @package Core\Routing\Interfaces
 */
interface RouteMatcherInterface
{
    /**
     * @param ServerRequestInterface $serverRequest
     * @param RouteCollectionInterface $routeCollection
     * @return RouteInterface
     */
    public function matchRequest(ServerRequestInterface $serverRequest, RouteCollectionInterface $routeCollection): RouteInterface;
}