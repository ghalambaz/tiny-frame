<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Interfaces\RouteParameterCollectionInterface;
use InvalidArgumentException;

/**
 * Class RouteParameterCollection
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteParameterCollection implements RouteParameterCollectionInterface
{

    /**
     * @var array
     */
    private array $parameters;

    /**
     * RouteParameterCollection constructor.
     */
    public function __construct()
    {
        $this->parameters = [];
    }

    /**
     * @param string $name
     * @return RouteParameter|null
     */
    public function getParameter(string $name)
    {
        return $this->parameters[$name] ?? null;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->parameters[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return isset($this->parameters[$offset]) ? $this->parameters[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($value instanceof RouteParameter) {
            $this->parameters[$offset] = $value;
        } else {
            throw new InvalidArgumentException("Value must be instance of RouterParameter");
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->parameters[$offset]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->parameters);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->parameters);
    }

    /**
     * @return mixed|void
     */
    public function next()
    {
        return next($this->parameters);
    }

    /**
     * @return bool|float|int|string|null
     */
    public function key()
    {
        return key($this->parameters);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $key = key($this->parameters);
        return ($key !== NULL && $key !== FALSE);
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->parameters);
    }
}