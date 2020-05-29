<?php
declare(strict_types=1);

namespace Core\Exception;


use Exception;
use Throwable;

/**
 * Class MethodNotImplementedException
 * @package Core\Http\Message\Exception
 * @author Ali Ghalambaz
 */
class MethodNotImplementedException extends Exception
{
    /**
     * MethodNotImplementedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Method {$message}() Not Implemented";
        parent::__construct($message, $code, $previous);
    }
}