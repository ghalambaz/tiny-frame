<?php
declare(strict_types=1);

namespace Core\Routing\Objects;


use Core\Routing\Interfaces\RouteParameterInterface;

/**
 * Class RouteParameter
 * @package Core\Routing
 * @author Ali Ghalambaz
 */
class RouteParameter implements RouteParameterInterface
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string|null
     */
    private ?string $default;   //mixed data type!
    /**
     * @var string|null
     */
    private ?string $pattern;
    /**
     * @var string
     */
    private string $value;

    /**
     * RouteParameter constructor.
     * @param string $name
     * @param string|null $pattern
     * @param string|null $default
     */
    public function __construct(string $name, ?string $pattern, ?string $default = null)
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this|RouteParameterInterface
     */
    public function setName(string $name): RouteParameterInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return $this|RouteParameterInterface
     */
    public function setPattern(string $pattern): RouteParameterInterface
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * @param string $defaultValue
     * @return $this|RouteParameterInterface
     */
    public function setDefaultValue(?string $defaultValue): RouteParameterInterface
    {
        $this->default = $defaultValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultValue(): string
    {
        return $this->default;
    }

    /**
     * @return string|null
     */
    public function getValue() : ?string
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return RouteParameterInterface|void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}