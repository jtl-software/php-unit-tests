<?php


namespace Jtl\UnitTest;


class TestCaseException extends \Exception
{
    public const
        CLASS_NOT_FOUND = 10;

    /**
     * @param string $className
     * @return TestCaseException
     */
    public static function classNotFound(string $className): self
    {
        return new static(sprintf('Class %s not found', $className), self::CLASS_NOT_FOUND);
    }
}