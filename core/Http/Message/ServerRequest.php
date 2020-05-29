<?php
declare(strict_types=1);

namespace Core\Http\Message;


use Core\Exception\MethodNotImplementedException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;


/**
 * Class ServerRequest
 * @package Core\Http\Message
 * @author Ali Ghalambaz
 */
class ServerRequest extends Request implements ServerRequestInterface
{

    /**
     * @var array
     */
    private ?array $serverParams;
    /**
     * @var array
     */
    private ?array $queryParams;

    /**
     * ServerRequest constructor.
     * @param UriInterface|null $uri
     * @param array $serverParams
     * @param array $queryParams
     * @param string $method
     */
    public function __construct(
        UriInterface $uri,
        array $serverParams = [],
        array $queryParams = [],
        string $method = 'GET'
    )
    {

        if ($method !== null) {
            $this->method = $method;
        }

        $this->uri = $uri;
        $this->serverParams = $serverParams;
        $this->queryParams = $queryParams;
    }

    /**
     * @return array
     */
    public function getServerParams()
    {
        return $this->serverParams;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @param array $query
     * @return ServerRequest
     */
    public function withQueryParams(array $query)
    {
        $clone = clone $this;
        $clone->queryParams = $query;

        return $clone;
    }

    /**
     * @throws MethodNotImplementedException
     */
    public function getCookieParams()
    {
        // TODO: Implement getCookieParams() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param array $cookies
     * @throws MethodNotImplementedException
     */
    public function withCookieParams(array $cookies)
    {
        // TODO: Implement withCookieParams() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @throws MethodNotImplementedException
     */
    public function getUploadedFiles()
    {
        // TODO: Implement getUploadedFiles() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param array $uploadedFiles
     * @throws MethodNotImplementedException
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        // TODO: Implement withUploadedFiles() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @throws MethodNotImplementedException
     */
    public function getParsedBody()
    {
        // TODO: Implement getParsedBody() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @throws MethodNotImplementedException
     */
    public function withParsedBody($data)
    {
        // TODO: Implement withParsedBody() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @throws MethodNotImplementedException
     */
    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @param null|string $default
     * @throws MethodNotImplementedException
     */
    public function getAttribute($name, $default = null)
    {
        // TODO: Implement getAttribute() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws MethodNotImplementedException
     */
    public function withAttribute($name, $value)
    {
        // TODO: Implement withAttribute() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @throws MethodNotImplementedException
     */
    public function withoutAttribute($name)
    {
        // TODO: Implement withoutAttribute() method.
        throw new MethodNotImplementedException(__METHOD__);
    }
}