<?php


namespace Core\Kernel;


use Psr\Container\ContainerInterface;

abstract class ControllerAbstract
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;
    protected TemplateEngineInterface $templateEngine;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->templateEngine = $this->container->get('template.engine');
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
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    public function has(string $id): bool
    {
        return $this->container->has($id);
    }

    public function get(string $id)
    {
        return $this->container->get($id);
    }

    public function render($file, array $data)
    {
        return $this->templateEngine->render($file, $data);
    }


}
