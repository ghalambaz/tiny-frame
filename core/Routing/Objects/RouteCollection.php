<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Interfaces\RouteCollectionInterface;
use InvalidArgumentException;

/**
 * Class RouteCollection
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteCollection implements RouteCollectionInterface
{
    /**
     * @var array
     */
    private array $routes;

    /**
     * RouteCollection constructor.
     */
    public function __construct()
    {
        $this->routes = [];
    }

    /**
     * @param array $routes
     */
    public function addRoutes(array $routes)
    {
        $this->routes = array_filter($this->routes, function ($item) {
            return $item instanceof Route;
        });
    }

    /**
     * @param string $name
     * @return Route
     */
    public function getRoute(string $name)
    {
        return $this->routes['name'] ?? null;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->routes[$offset]);
    }

    /**
     * @param string|int $offset
     * @return Route|null
     */
    public function offsetGet($offset)
    {
        return isset($this->routes[$offset]) ? $this->routes[$offset] : null;
    }

    /**
     * @param string|int $offset
     * @param Route $value
     */
    public function offsetSet($offset, $value)
    {
        if ($value instanceof Route) {
            $this->routes[$offset] = $value;
        } else {
            throw new InvalidArgumentException("Value must be instance of Route");
        }
    }

    /**
     * @param string|int $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->routes[$offset]);
    }


    /**
     * @return int
     */
    public function count()
    {
        return count($this->routes);
    }

    /**
     * @return Route
     */
    public function current(): Route
    {
        return current($this->routes);
    }

    /**
     * @return Route|bool
     */
    public function next()
    {
        return next($this->routes);
    }

    /**
     * @return bool|int|string|null
     */
    public function key()
    {
        return key($this->routes);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        $key = key($this->routes);
        return ($key !== NULL && $key !== FALSE);
    }


    /**
     *
     */
    public function rewind(): void
    {
        reset($this->routes);
    }
}