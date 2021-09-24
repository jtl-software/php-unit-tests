<?php

namespace Jtl\UnitTest;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @param object $object
     * @param string $methodName
     * @param mixed ...$arguments
     * @return mixed
     * @throws \ReflectionException
     */
    protected function invokeMethodFromObject(object $object, string $methodName, ...$arguments)
    {
        $reflectionClass = new \ReflectionClass($object);
        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invoke($object, ...$arguments);
    }

    /**
     * @param object $object
     * @param string $propertyName
     * @return mixed
     * @throws \ReflectionException
     */
    public function getPropertyValueFromObject(object $object, string $propertyName)
    {
        $reflectionClass = new \ReflectionClass($object);
        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }

    /**
     * @param object $object
     * @param string $propertyName
     * @param mixed $value
     * @throws \ReflectionException
     */
    protected function setPropertyValueFromObject(object $object, string $propertyName, $value): void
    {
        $reflectionClass = new \ReflectionClass($object);
        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }

    /**
     * @param string $className
     * @return object
     * @throws TestCaseException
     * @throws \ReflectionException
     */
    protected function createInstanceWithoutConstructor(string $className)
    {
        if(!class_exists($className)) {
            throw TestCaseException::classNotFound($className);
        }

        return (new \ReflectionClass($className))->newInstanceWithoutConstructor();
    }
}
