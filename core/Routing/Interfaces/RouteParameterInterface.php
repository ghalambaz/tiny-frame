<?php
declare(strict_types=1);

namespace Core\Routing\Interfaces;


/**
 * Interface RouteParameterInterface
 * @package Core\Routing\Interfaces
 */
interface RouteParameterInterface
{
    /**
     * @param string $name
     * @return RouteParameterInterface
     */
    public function setName(string $name): RouteParameterInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $pattern
     * @return RouteParameterInterface
     */
    public function setPattern(string $pattern): RouteParameterInterface;

    /**
     * @return string
     */
    public function getPattern(): ?string;

    /**
     * @param string $defaultValue
     * @return RouteParameterInterface
     */
    public function setDefaultValue(string $defaultValue): RouteParameterInterface;

    /**
     * @return string
     */
    public function getDefaultValue(): ?string;

    /**
     * @param $value
     * @return RouteParameterInterface
     */
    public function setValue($value);

    /**
     * @return string
     */
    public function getValue() : ?string ;
}