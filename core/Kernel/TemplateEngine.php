<?php
declare(strict_types=1);

namespace Core\Kernel;


/**
 * Class TemplateEngine
 * @package Core\Kernel
 * @author Ali Ghalambaz
 */
class TemplateEngine implements TemplateEngineInterface
{
    /**
     * @var mixed
     */
    private $templateEngine;

    /**
     * TemplateEngine constructor.
     * @param $templateEngine
     */
    public function __construct($templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param $file
     * @param array $data
     * @return mixed
     */
    public function render(string $file, array $data)
    {
        return $this->templateEngine->render($file, $data);
    }
}