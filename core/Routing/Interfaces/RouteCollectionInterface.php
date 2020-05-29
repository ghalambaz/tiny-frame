<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


use ArrayAccess;
use Countable;
use Iterator;

/**
 * Interface RouteCollectionInterface
 * @package Core\Routing\Interfaces
 */
interface RouteCollectionInterface extends ArrayAccess, Countable, Iterator
{

}