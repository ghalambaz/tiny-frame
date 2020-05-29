<?php
declare(strict_types=1);

namespace Core\Routing;


use Core\Routing\Interfaces\RouteInterface;


/**
 * Class RouteCompiler
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteCompiler
{
    /**
     * Regex deliminator.
     *
     * @var string
     */
    public const DELIMINATOR = '`';


    /**
     * @param RouteInterface $route
     * @return string
     */
    public static function compile(RouteInterface $route)
    {
        $regex = $route->getPath();
        foreach ($route->getParameterCollection() as $parameter)
        {
            $paramRegex = sprintf('(?<%s>%s)',$parameter->getName(),empty($parameter->getPattern())?'.+?':$parameter->getPattern());

            $regex = str_replace("{{$parameter->getName()}}",$paramRegex,$regex);
        }

        return self::DELIMINATOR . '^' . $regex . '$' . self::DELIMINATOR;
    }

}
