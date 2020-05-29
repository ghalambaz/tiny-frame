<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


/**
 * Interface RouteInterface
 * @package Core\Routing\Interfaces
 */
interface RouteInterface
{
    /**
     * @param string $name
     * @return RouteInterface
     */
    public function setName(string $name): RouteInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $path
     * @return RouteInterface
     */
    public function setPath(string $path): RouteInterface;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param string $callback
     * @return RouteInterface
     */
    public function setCallback(string $callback): RouteInterface;

    /**
     * @return string
     */
    public function getCallback(): string;

    /**
     * @param RouteParameterCollectionInterface $parameterCollection
     * @return RouteInterface
     */
    public function setParameterCollection(RouteParameterCollectionInterface $parameterCollection): RouteInterface;

    /**
     * @return RouteParameterCollectionInterface
     */
    public function getParameterCollection(): RouteParameterCollectionInterface;

    /**
     * @param string $name
     * @param RouteParameterInterface $parameter
     * @return RouteInterface
     */
    public function setParameter(string $name, RouteParameterInterface $parameter): RouteInterface;

    /**
     * @param string $name
     * @return RouteParameterInterface|null
     */
    public function getParameter(string $name): ?RouteParameterInterface;

}