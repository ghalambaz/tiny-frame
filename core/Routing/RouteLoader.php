<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\ResourceLoader\Exception\DataNotLoadedException;
use Core\ResourceLoader\ResourceLoaderInterface;

/**
 * Class RouteLoader
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteLoader implements ResourceLoaderInterface
{
    const ROUTE_CONFIG_KEY = 'routes';
    /**
     * @var ResourceLoaderInterface
     */
    private ResourceLoaderInterface $loader;
    /**
     * @var string
     */
    private string $data;

    /**
     * RouteLoader constructor.
     * @param ResourceLoaderInterface $loader
     */
    public function __construct(ResourceLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param string $path
     * @return array
     * @throws DataNotLoadedException
     */
    public function load(string $path)
    {
        $data = $this->loader->load($path);
        if (empty($data) || !isset($data[self::ROUTE_CONFIG_KEY]))
            throw new DataNotLoadedException("Couldn'n load data from {$path}");
        return $data[self::ROUTE_CONFIG_KEY];
    }

}