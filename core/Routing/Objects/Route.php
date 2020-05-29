<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Interfaces\RouteInterface;
use Core\Routing\Interfaces\RouteParameterCollectionInterface;
use Core\Routing\Interfaces\RouteParameterInterface;
use InvalidArgumentException;

/**
 * Class Route
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class Route implements RouteInterface
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $callback;
    /**
     * @var string
     */
    private string $path;
    /**
     * @var RouteParameterCollectionInterface|null
     */
    private ?RouteParameterCollectionInterface $parameterCollection;

    /**
     * Route constructor.
     * @param string $name
     * @param $callback
     * @param string $path
     * @param RouteParameterCollectionInterface|null $parameterCollection
     */
    public function __construct(string $name, $callback, string $path, ?RouteParameterCollectionInterface $parameterCollection = null)
    {
        $this->name = $name;
        $this->callback = $callback;
        $this->path = $path;
        $this->parameterCollection = $parameterCollection;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this|RouteInterface
     */
    public function setName(string $name): RouteInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this|RouteInterface
     */
    public function setPath(string $path): RouteInterface
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallback(): string
    {
        return $this->callback;
    }

    /**
     * @param string $callback
     * @return $this|RouteInterface
     */
    public function setCallback(string $callback): RouteInterface
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @param string $name
     * @param RouteParameterInterface $parameter
     * @return $this|RouteInterface
     */
    public function setParameter(string $name, RouteParameterInterface $parameter): RouteInterface
    {
        $this->parameterCollection[$name] = $parameter;

        return $this;
    }

    /**
     * @param string $name
     * @return RouteParameterInterface|null
     * @throws InvalidArgumentException
     */
    public function getParameter(string $name): ?RouteParameterInterface
    {
        if(empty($this->parameterCollection[$name]))
            throw new InvalidArgumentException("Parameter {$name} Not Found");
        return $this->parameterCollection[$name];
    }

    /**
     * @return RouteParameterCollectionInterface
     */
    public function getParameterCollection(): RouteParameterCollectionInterface
    {
        return $this->parameterCollection;
    }

    /**
     * @param RouteParameterCollectionInterface $routeCollection
     * @return $this|RouteInterface
     */
    public function setParameterCollection(RouteParameterCollectionInterface $routeCollection): RouteInterface
    {
        $this->parameterCollection = $routeCollection;

        return $this;
    }
}