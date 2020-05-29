<?php
declare(strict_types=1);

namespace Core\Kernel;


use Core\Container\Exception\NotFoundException;
use Psr\Container\ContainerInterface;

/**
 * Class ControllerAbstract
 * @package Core\Kernel
 * @author Ali Ghalambaz
 */
abstract class ControllerAbstract
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;
    /**
     * @var TemplateEngineInterface
     */
    protected TemplateEngineInterface $templateEngine;

    /**
     * ControllerAbstract constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container): ControllerAbstract
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return $this->container->has($id);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function get(string $id)
    {
        return $this->container->get($id);
    }

    /**
     * @param $file
     * @param array $data
     * @return mixed
     * @throws NotFoundException
     */
    public function render($file, array $data)
    {
        if(empty($this->templateEngine)) {
            if (!$this->container->has('template.engine'))
                throw new NotFoundException('couldn\'t found any template.engine');
            $this->templateEngine = $this->container->get('template.engine');
        }
        return $this->templateEngine->render($file, $data);
    }


}
