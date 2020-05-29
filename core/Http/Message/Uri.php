<?php
declare(strict_types=1);

namespace Core\Http\Message;


use Core\Exception\MethodNotImplementedException;
use Core\Http\Message\Exception\InvalidArgumentException;
use Psr\Http\Message\UriInterface;

/**
 * Class Uri
 * Simple Implementation of PSR7/Uri
 * @package Core\Http\Message
 * @author  Ali Ghalambaz
 */
class Uri implements UriInterface
{

    /**
     * @var string
     */
    private string $scheme;

    /**
     * @var array|string[]
     */
    private array $schemes = ['http','https'];

    /**
     * @var string
     */
    private string $host;
    /**
     * @var int|null
     */
    private ?int $port;
    /**
     * @var string
     */
    private string $path;
    /**
     * @var string|null
     */
    private ?string $query;
    /**
     * @var string|null
     */
    private ?string $fragment;

    /**
     * Uri constructor.
     * @param string $scheme
     * @param string $host
     * @param int|null $port
     * @param string $path
     * @param string|null $query
     * @param string|null $fragment
     * @throws InvalidArgumentException
     */
    public function __construct(string $scheme, string $host, ?int $port, string $path, ?string $query, ?string $fragment)
    {
        if(!in_array($scheme,$this->schemes))
            throw new InvalidArgumentException('Scheme Must be http or https');

        if($port< 0 || $port >65535)
            throw new InvalidArgumentException('Port Number must between 0 and 65535');
        $this->scheme = strtolower($scheme);
        $this->host = strtolower($host);
        $this->port = $port;
        $this->path = $path;
        $this->query = $query;
        $this->fragment = $fragment;
    }

    /**
     * Uri constructor.
     * @param string $uri
     * @return Uri
     * @throws InvalidArgumentException
     */
    public static function create(string $uri)
    {
        $parts = parse_url($uri);

        if (false === $parts)
            throw new InvalidArgumentException('is not a valid uri');

        if(empty($parts['host']) || empty($parts['scheme']))
            throw new InvalidArgumentException('without scheme or host is not a valid uri');
        //it's better to sanitize scheme [http,https,...] and port between [0-65535] and  ...
        $scheme = $parts['scheme'];
        $host = $parts['host'];
        $port = $parts['port'] ?? null;
        $path = $parts['path'] ?? '';
        $query = $parts['query'] ?? '';
        $fragment = $parts['fragment'] ?? '';
        return new Uri($scheme,$host,$port,$path,$query,$fragment);
    }

    /**
     * @return string|void
     */
    public function __toString()
    {
        $str = '';
        $str.=($this->scheme??'').'://';
        $str.=$this->host??'';
        $str.=empty($this->port)?'':(':'.$this->port);
        $str.=$this->path??'';
        $str.=empty($this->query)?'':('?'.$this->query);
        $str.=empty($this->fragment)?'':('#'.$this->fragment);
        return $str;
    }
    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return int|null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return string|null
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * @param string $scheme
     * @return $this|Uri
     */
    public function withScheme($scheme)
    {
        if ($scheme === $this->scheme) {
            return $this;
        }

        $clone = clone $this;
        $clone->scheme = $scheme;

        return $clone;
    }

    /**
     * @param string $host
     * @return $this|Uri
     */
    public function withHost($host)
    {
        if ($host === $this->host) {
            return $this;
        }

        $clone = clone $this;
        $clone->host = $host;

        return $clone;
    }

    /**
     * @param int|null $port
     * @return $this|Uri
     */
    public function withPort($port)
    {
        if ($port === $this->port) {
            return $this;
        }

        $clone = clone $this;
        $clone->port = (int)$port;

        return $clone;
    }

    /**
     * @param string $path
     * @return $this|Uri
     */
    public function withPath($path)
    {
        if ($path === $this->path) {
            return $this;
        }

        $clone = clone $this;
        $clone->path = $path;
        return $clone;
    }

    /**
     * @param string $query
     * @return $this|Uri
     */
    public function withQuery($query)
    {
        if ($query === $this->query) {
            return $this;
        }

        $clone = clone $this;
        $clone->query = $query;

        return $clone;
    }

    /**
     * @param string $fragment
     * @return $this|Uri
     */
    public function withFragment($fragment)
    {
        if ($fragment === $this->fragment) {
            return $this;
        }

        $clone = clone $this;
        $clone->fragment = $fragment;

        return $clone;
    }


    /**
     * @param string $user
     * @param null $password
     * @return Uri|void
     * @throws MethodNotImplementedException
     */
    public function withUserInfo($user, $password = null)
    {
        // TODO: Implement withUserInfo() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @return string|void
     * @throws MethodNotImplementedException
     */
    public function getAuthority()
    {
        // TODO: Implement getAuthority() method.
        throw new MethodNotImplementedException(__METHOD__);
    }

    /**
     * @return string|void
     * @throws MethodNotImplementedException
     */
    public function getUserInfo()
    {
        // TODO: Implement getUserInfo() method.
        throw new MethodNotImplementedException(__METHOD__);
    }
}