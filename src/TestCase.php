<?php

namespace Jtl\UnitTest;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param string|object $classNameOrObject
     * @param string $methodName
     * @param mixed ...$arguments
     * @return mixed
     * @throws \ReflectionException
     */
    protected function invokeMethod($classNameOrObject, string $methodName, ...$arguments)
    {
        $reflectionMethod = new \ReflectionMethod($classNameOrObject, $methodName);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invoke($classNameOrObject, ...$arguments);
    }

    /**
     * @param string|object $classNameOrObject
     * @param string $propertyName
     * @return mixed
     */
    public function retrievePropertyValue($classNameOrObject, string $propertyName)
    {
        $reflectionClass = new \ReflectionClass($classNameOrObject);
        do {
            if ($reflectionClass->hasProperty($propertyName)) {
                break;
            }
        } while ($reflectionClass = $reflectionClass->getParentClass());

        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($classNameOrObject);
    }

    /**
     * @param string|object $classNameOrObject
     * @param string $propertyName
     * @param mixed $value
     * @throws \ReflectionException
     */
    protected function setProperty($classNameOrObject, string $propertyName, $value): void
    {
        $reflectionProperty = new \ReflectionProperty($classNameOrObject, $propertyName);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($classNameOrObject, $value);
    }

    /**
     * @param string $className
     * @return object
     * @throws TestCaseException
     * @throws \ReflectionException
     */
    protected function createInstanceWithoutConstructor(string $className)
    {
        if (!class_exists($className)) {
            throw TestCaseException::classNotFound($className);
        }

        return (new \ReflectionClass($className))->newInstanceWithoutConstructor();
    }
}
