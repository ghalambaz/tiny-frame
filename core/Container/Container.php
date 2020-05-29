<?php
declare(strict_types=1);

namespace Core\Container;


use Core\Container\Exception\InvalidServiceException;
use Core\Container\Exception\NotFoundException;
use Psr\Container\ContainerInterface;

/**
 * Class Container
 * Small Container implemented for use in a small framework! doesn't support auto wiring.
 * if you want using auto wiring functionality add it with help of PHP Reflection APIs
 * @package Core\Container
 * @author Ali Ghalambaz
 */
class Container implements ContainerInterface
{

    /**
     * @var array
     */
    private array $services;

    /**
     * @param string $serviceId
     * @param callable $callback
     * @return Container
     */
    public function registerService(string $serviceId,callable $callback): Container
    {
        if(empty($this->services)) $this->services = [];
        $this->services[$serviceId] = $callback;
        return $this;
    }
    /**
     * @var array
     */
    private array $serviceCollection;

    /**
     * Container constructor.
     * @param array $services
     */
    public function __construct(array $services = [])
    {
        $this->services = $services;
        $this->serviceCollection = [];
    }

    /**
     * {@inheritDoc}
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException();
        }
        if (isset($this->serviceCollection[$id])) {
            return $this->serviceCollection[$id];
        } else {
            $this->serviceCollection[$id] = $this->instantiateService($id);
            return $this->serviceCollection[$id];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function has($id)
    {
        return isset($this->services[$id]);
    }

    /**
     * @param string $id
     * @return mixed
     * @throws InvalidServiceException
     */
    private function instantiateService(string $id)
    {
        if(!is_callable($this->services[$id]))
            throw new InvalidServiceException('couldn\'t instantiate service because is not a callable');
            return $this->services[$id]();

    }
}