<?php

declare(strict_types=1);

namespace Jadessoriano\Mobivate\Requests;

use ErrorException;
use ReflectionClass;
use ReflectionProperty;

abstract class BaseRequest
{
    /** @var array<string, string>|null */
    protected static ?array $propertySetters = null;

    /**
     * Magic method to handle dynamic setters like setFoo($value).
     *
     * @throws ErrorException
     */
    public function __call(string $name, array $arguments): static
    {
        // Cache the map of setMethodName => propertyName
        if (static::$propertySetters === null) {
            static::$propertySetters = [];
            $reflection = new ReflectionClass(static::class);

            foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
                if (! $property->isStatic()) {
                    $field = $property->getName();
                    static::$propertySetters['set'.ucfirst($field)] = $field;
                }
            }
        }

        if (! isset(static::$propertySetters[$name])) {
            throw new ErrorException(sprintf('Call to undefined method %s::%s()', static::class, $name));
        }

        if (count($arguments) !== 1) {
            throw new ErrorException(sprintf('Method %s::%s() expects exactly 1 argument, %d given.', static::class, $name, count($arguments)));
        }

        $property = static::$propertySetters[$name];
        $this->$property = $arguments[0];

        return $this;
    }
}
