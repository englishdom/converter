<?php

namespace Unit;

use PHPUnit\Framework\TestCase;

/**
 * Class ExtendTestCase
 * @package Common\Test
 */
class ExtendTestCase extends TestCase
{
    /**
     * @param $className
     * @param $methodName
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    protected static function getProtectedMethod($className, $methodName) {
        $class = new \ReflectionClass($className);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @param $className
     * @param $propertyName
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    protected static function getProtectedProperty($className, $propertyName)
    {
        $class = new \ReflectionClass($className);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        return $property;
    }

    /**
     * @param $object
     * @param $propertyName
     * @param $propertyValue
     * @throws \ReflectionException
     */
    protected function setProtectedProperty($object, $propertyName, $propertyValue)
    {
        $reflectionClass = new \ReflectionClass($object);
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $propertyValue);
        $property->setAccessible(false);
    }
}
