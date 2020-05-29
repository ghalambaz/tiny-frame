<?php
declare(strict_types=1);

namespace Core\ResourceLoader;


use Core\ResourceLoader\Exception\ParseException;
use Symfony\Component\Yaml\Exception\ParseException as SymfonyYamlParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlLoader
 * @package Core\ResourceLoader
 * @author Ali Ghalambaz
 */
class YamlLoader implements ResourceLoaderInterface
{
    /**
     * @param string $path
     * @return mixed
     * @throws ParseException
     */
    public function load(string $path)
    {
        try {
            return Yaml::parseFile($path);
        } catch (SymfonyYamlParseException $e) {
            throw new ParseException("Invalid data in {$path}");
        }
    }
}