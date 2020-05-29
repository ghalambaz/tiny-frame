<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\ResourceLoader\ResourceLoaderInterface;
use Core\Routing\Exception\InvalidRouteException;
use Core\Routing\Interfaces\RouteCollectionBuilderInterface;
use Core\Routing\Interfaces\RouteCollectionInterface;
use Core\Routing\Interfaces\RouteInterface;
use Core\Routing\Interfaces\RouteMatcherInterface;
use Core\Routing\Interfaces\RouterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class Router
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class Router implements RouterInterface
{
    /**
     * @var RouteCollectionInterface
     */
    private RouteCollectionInterface $routeCollection;
    /**
     * @var ResourceLoaderInterface
     */
    private ResourceLoaderInterface $loader;
    /**
     * @var RouteMatcherInterface
     */
    private RouteMatcherInterface $routeMatcher;
    /**
     * @var string
     */
    private string $routeConfigPath;


    /**
     * Router constructor.
     * @param string $routeConfigPath
     * @param ResourceLoaderInterface $loader
     * @param RouteMatcherInterface $routeMatcher
     */
    public function __construct(
        string $routeConfigPath,
        ResourceLoaderInterface $loader,
        RouteMatcherInterface $routeMatcher)
    {
        $this->routeConfigPath = $routeConfigPath;
        $this->loader = $loader;
        $this->routeMatcher = $routeMatcher;
    }

    /**
     * @param ServerRequestInterface $request
     * @return RouteInterface
     * @throws InvalidRouteException
     */
    public function matchRequest(ServerRequestInterface $request): RouteInterface
    {
        return $this->routeMatcher->matchRequest($request, $this->getRouteCollection());
    }

    /**
     * @return RouteCollectionInterface
     * @throws InvalidRouteException
     */
    public function getRouteCollection(): RouteCollectionInterface
    {
        if (empty($this->routeCollection)) {
            $routesData = $this->loader->load($this->routeConfigPath);
            $this->routeCollection = (new RouteCollectionBuilder())->build($routesData);
        }
        return $this->routeCollection;
    }

    /**
     * @param RouteInterface $route
     * @param ContainerInterface $container
     * @return mixed
     * @throws InvalidRouteException
     */
    public function call(RouteInterface $route, ContainerInterface $container)
    {
        $callback = $route->getCallback();
        $callback_array = explode(":", $callback);
        if (count($callback_array) != 2)
            throw new InvalidRouteException("Route {$route->getName()} Callback Is not valid");
        try {
            $reflectionClass = new ReflectionClass($callback_array[0]);
            if (!$reflectionClass->isSubclassOf("Core\Kernel\ControllerAbstract"))
                throw new InvalidRouteException("Controller {$callback_array[0]} must be subclass of Core\Kernel\ControllerAbstract");

            $controller = $reflectionClass->newInstance($container);
            $reflectionMethod = $reflectionClass->getMethod($callback_array[1]);
            $methodParameters = $reflectionMethod->getParameters();
            $matchedParams = [];
            foreach ($methodParameters as $rawParam) {

                if ($route->hasParameter($rawParam->getName())) {
                    $routeParam = $route->getParameter($rawParam->getName());
                    $matchedParams[$rawParam->getName()] = $routeParam->getValue();
                }
                else
                    $matchedParams[$rawParam->getName()] = $rawParam->getDefaultValue();
            }
            return $reflectionMethod->invokeArgs($controller, $matchedParams);
        } catch (ReflectionException $e) {
            throw new InvalidRouteException("Class or Method not found!");
        }
    }
}