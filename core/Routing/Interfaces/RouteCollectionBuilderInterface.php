<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


/**
 * Interface RouteCollectionBuilderInterface
 * @package Core\Routing\Interfaces
 */
interface RouteCollectionBuilderInterface
{
    /**
     * @param array $routeData
     * @return RouteCollectionInterface
     */
    public function build(array $routeData): RouteCollectionInterface;
}