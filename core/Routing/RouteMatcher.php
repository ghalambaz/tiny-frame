<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Exception\RouteNotFoundException;
use Core\Routing\Interfaces\RouteCollectionInterface;
use Core\Routing\Interfaces\RouteInterface;
use Core\Routing\Interfaces\RouteMatcherInterface;
use Core\Routing\Objects\Route;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class RouteMatcher
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteMatcher implements RouteMatcherInterface
{

    /**
     * @param $path
     * @return array
     */
    public static function getRouteParameters($path)
    {
        $matches = [];
        preg_match_all('`\{(\w+)\}`', $path, $matches, PREG_SET_ORDER);
        return (array_column($matches, 1));
    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @param RouteCollectionInterface $routeCollection
     * @return RouteInterface
     * @throws RouteNotFoundException
     */
    public function matchRequest(ServerRequestInterface $serverRequest, RouteCollectionInterface $routeCollection): RouteInterface
    {
        $path = '/' . ltrim($serverRequest->getUri()->getPath(), '/');
        foreach ($routeCollection as $route) {
            if ($this->isMatched($route, $path)) {
                return $route;
            }
        }
        throw new RouteNotFoundException();
    }

    /**
     * @param Route $route
     * @param string $path
     * @return bool
     */
    private function isMatched(Route $route, string $path): bool
    {
        $constraints = [];
        foreach ($route->getParameterCollection() as $param) {
            if (!empty($param->getPattern()))
                $constraints = array_merge($constraints, array($param->getName() => $param->getPattern()));
        }
        $compiled = RouteCompiler::Compile($route);

        $matches = [];
        if (!preg_match($compiled, $path, $matches)) {
            return false;
        }

        foreach ($matches as $key => $value) {
            if (is_string($key)) {
                $route->getParameter($key)->setValue($value);
            }
        }
        return true;
    }
}