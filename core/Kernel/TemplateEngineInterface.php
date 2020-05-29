<?php
declare(strict_types=1);

namespace Core\Kernel;


/**
 * Interface TemplateEngineInterface
 * @package Core\Kernel
 */
interface TemplateEngineInterface
{
    /**
     * @param string $file
     * @param array $data
     * @return mixed
     */
    public function render(string $file, array $data);
}