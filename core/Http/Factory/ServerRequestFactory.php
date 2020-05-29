<?php
declare(strict_types=1);

namespace Core\Http\Factory;


use Core\Exception\MethodNotImplementedException;
use Core\Http\Message\ServerRequest;
use Core\Http\Message\Uri;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class ServerRequestFactory
 * @package Core\Http\Factory
 * @author Ali Ghalambaz
 */
class ServerRequestFactory implements ServerRequestFactoryInterface
{

    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $serverParams
     * @return ServerRequestInterface
     * @throws MethodNotImplementedException
     */
    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        //TODO implement createServerRequest()
        throw new MethodNotImplementedException(__METHOD__);
    }

    public function createFromGlobals()
    {
        //for faster development I used code snippet code with (many) modification
        //and updated to 7.4
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET' ;
        $scheme = 'http';
        $isHttps = $_SERVER['HTTPS'] ?? null;
        if (!empty($isHttps) && strtolower($isHttps) !== 'off') {
            $scheme = 'https';
        }
        $port = $_SERVER['SERVER_PORT'] ?? null;
        if (!empty($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
            $pos = strrpos($host, ':');
            if ($pos !== false) {
                $port = substr($host, $pos + 1);
                $host = substr($host, 0, $pos);
            }
        } else {
            $host = $_SERVER['SERVER_NAME'] ?? '';
        }
        $uri = $_SERVER['REQUEST_URI'] ?? '' ;
        $path = parse_url($uri, PHP_URL_PATH);
        if (empty($path)) {
            $path = $_SERVER['PATH_INFO'] ?? '';
        }
        $query = parse_url($uri, PHP_URL_QUERY);
        if (empty($query)) {
            $query = $_SERVER['QUERY_STRING'] ?? '' ;
        }

        return new ServerRequest(new Uri($scheme, $host, (int)$port, $path, $query, null), [], [], $method);
    }
}