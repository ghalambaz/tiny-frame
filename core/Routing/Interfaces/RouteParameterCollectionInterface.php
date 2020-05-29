<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


use ArrayAccess;
use Countable;
use Iterator;

/**
 * Interface RouteParameterCollectionInterface
 * @package Core\Routing\Interfaces
 */
interface RouteParameterCollectionInterface extends ArrayAccess, Countable, Iterator
{

}