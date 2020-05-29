<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Exception\InvalidRouteException;
use Core\Routing\Interfaces\RouteCollectionBuilderInterface;
use Core\Routing\Objects\Route;
use Core\Routing\Objects\RouteCollection;
use Core\Routing\Objects\RouteParameter;
use Core\Routing\Objects\RouteParameterCollection;

/**
 * Class RouteCollectionBuilder
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteCollectionBuilder implements RouteCollectionBuilderInterface
{
    /**
     * @var RouteCollection
     */
    private RouteCollection $routerCollection;
    /**
     * @var array
     */
    private array $routeData;

    /**
     * RouteCollectionBuilder constructor.
     */
    public function __construct()
    {

        $this->routerCollection = new RouteCollection();
    }

    /**
     * @param array $routeData
     * @return RouteCollection
     * @throws InvalidRouteException
     */
    public function build($routeData): RouteCollection
    {
        $this->routeData = $routeData;
        foreach ($this->routeData as $routeName => $route_array) {
            if (!isset($route_array['callback']) || !isset($route_array['path']))
                throw new InvalidRouteException("Make sure all data is provided like callback and path for your route");

            $parameters = new RouteParameterCollection();
            $paramNames = RouteMatcher::getRouteParameters($route_array['path']);
            foreach ($paramNames as $paramName) {
                $parameters[(string)$paramName] = new RouteParameter($paramName, '', null);
            }

            if (isset($route_array['parameters'])) {
                foreach ($route_array['parameters'] as $paramName => $parameterArray) {
                    //it will ignore additional parameter defenition in parameter section
                    if (isset($parameters[$paramName])) {
                        $parameters->getParameter((string)$paramName)
                            ->setPattern($parameterArray['pattern'] ?? '')
                            ->setDefaultValue($parameterArray['default'] ?? null);
                    }
                }
            }

            $route = new Route($routeName, $route_array['callback'], $route_array['path'], $parameters);
            $this->routerCollection[$routeName] = $route;
        }
        return $this->routerCollection;
    }

}