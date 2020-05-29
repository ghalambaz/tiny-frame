<?php
declare(strict_types=1);

namespace Core\Http\Message\Exception;


use Exception;
use Throwable;

class MethodNotImplementedException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Method {$message}() Not Implemented";
        parent::__construct($message, $code, $previous);
    }
}