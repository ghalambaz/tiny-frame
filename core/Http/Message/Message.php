<?php
declare(strict_types=1);

namespace Core\Http\Message;


use Core\Exception\MethodNotImplementedException;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class Message
 * @package Core\Http\Message
 * @author Ali Ghalambaz
 */
class Message implements MessageInterface
{
    /**
     * @return string|void
     * @throws MethodNotImplementedException
     */
    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $version
     * @throws MethodNotImplementedException
     */
    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @return string[]|void
     * @throws MethodNotImplementedException
     */
    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @return bool|void
     * @throws MethodNotImplementedException
     */
    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @return string[]|void
     * @throws MethodNotImplementedException
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @return string|void
     * @throws MethodNotImplementedException
     */
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return Message|void
     * @throws MethodNotImplementedException
     */
    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return Message|void
     * @throws MethodNotImplementedException
     */
    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param string $name
     * @return Message|void
     * @throws MethodNotImplementedException
     */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @return StreamInterface|void
     * @throws MethodNotImplementedException
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @param StreamInterface $body
     * @return Message|void
     * @throws MethodNotImplementedException
     */
    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
        throw new MethodNotImplementedException(__METHOD__);
    }
}