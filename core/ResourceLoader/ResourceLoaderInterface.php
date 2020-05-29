<?php
declare(strict_types=1);

namespace Core\ResourceLoader;


/**
 * Interface ResourceLoaderInterface
 * @package Core\ResourceLoader
 */
interface ResourceLoaderInterface
{
    /**
     * @param string $path
     * @return mixed
     */
    public function load(string $path);
}