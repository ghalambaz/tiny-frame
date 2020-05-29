<?php
declare(strict_types=1);

namespace Core\Http\Message;



use Core\Exception\MethodNotImplementedException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class Request
 * @package Core\Http\Message
 * @author Ali Ghalmbaz
 */
class Request extends Message implements RequestInterface
{
    /**
     * @var string
     */
    protected string $method;

    /**
     * @var UriInterface
     */
    protected ?UriInterface $uri;

    /**
     * Request constructor.
     * @param string $method
     * @param UriInterface|null $uri
     */
    public function __construct(string $method, ?UriInterface $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }


    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Request
     */
    public function withMethod($method)
    {
        $clone = clone $this;
        $clone->method = $method;

        return $clone;
    }

    /**
     * @return UriInterface
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param UriInterface $uri
     * @param bool $preserveHost
     * @return Request
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        //TODO Implement support of $preserveHost
        $clone = clone $this;
        $clone->uri = $uri;

        return $clone;
    }

    /**
     * @throws MethodNotImplementedException
     */
    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param mixed $requestTarget
     * @throws MethodNotImplementedException
     */
    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
        throw new MethodNotImplementedException(__METHOD__);
    }
}