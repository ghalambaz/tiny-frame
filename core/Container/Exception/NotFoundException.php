<?php
declare(strict_types=1);

namespace Core\Container\Exception;


use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class NotFoundException
 * @package Core\Container\Exception
 * @author Ali Ghalambaz
 */
class NotFoundException extends Exception implements NotFoundExceptionInterface
{

}