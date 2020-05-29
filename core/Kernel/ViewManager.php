<?php
declare(strict_types=1);

namespace Core\Kernel;


/**
 * Class ViewManager
 * @package Core\Kernel
 * @author Ali Ghalambaz
 */
class ViewManager
{
    /**
     * @param $response
     */
    public function render($response)
    {
        echo $response;
    }
    /**
     * @param $response
     */
    public function renderPageNotFound()
    {
        echo "404 Not Found";
    }
}