<?php

namespace Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationTest extends TestCase
{

    public function testNotNullWhenValueIsEmptyDefaultMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('should not be empty');
        DomainValidation::notNull('');
    }

    public function testNotNullWhenValueIsNullDefaultMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('should not be empty');
        DomainValidation::notNull(null);
    }

    public function testNotNullWhenValueIsEmptyCustomMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('aaa');
        DomainValidation::notNull('', 'aaa');
    }


    public function testNotNullWhenValueIsNotEmpty()
    {
        DomainValidation::notNull('AA');
        $this->assertTrue(true);
    }

    public function testStrMaxLengthWhenValueIsLongerThanMaxValueDefaultMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The length must not me grater then 255 characters');
        DomainValidation::strMaxLenght(str_pad('A', 256));
    }

    public function testStrMaxLengthWhenValueIsLongerThanMaxValueCustomMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('custom message');
        DomainValidation::strMaxLenght(str_pad('A', 11), 10, 'custom message');
    }

    public function testStrMaxLengthWhenValueIsLessThanMaxValue()
    {
        DomainValidation::strMaxLenght(str_pad('A', 9), 10);
        $this->assertTrue(true);
    }

    public function testStrMaxLengthWhenValueIsEmpty()
    {
        DomainValidation::strMaxLenght('');
        $this->assertTrue(true);
    }

    public function testStrMaxLengthWhenValueIsNull()
    {
        DomainValidation::strMaxLenght(null);
        $this->assertTrue(true);
    }

    public function testStrMinLengthWhenValueIsLessThanMinValueDefaultMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The length must not at least 3 characters');
        DomainValidation::strMinLenght(str_pad('A', 2));
    }

    public function testStrMinLengthWhenValueIsLessThanMinValueCustomMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('custom message');
        DomainValidation::strMinLenght(str_pad('A', 9), 10, 'custom message');
    }

    public function testStrMinLengthWhenValueIsLongerThanMinValue()
    {
        DomainValidation::strMinLenght(str_pad('A', 11), 10);
        $this->assertTrue(true);
    }

    public function testStrMinLengthWhenValueIsEmpty()
    {
        $this->expectException(EntityValidationException::class);
        DomainValidation::strMinLenght('');
    }

    public function testStrMinLengthWhenValueNull()
    {
        $this->expectException(EntityValidationException::class);
        DomainValidation::strMinLenght('');
    }

    public function testStrCanNullAndMaxLenthWhenValueIsNull()
    {
        DomainValidation::strCanNullAndMaxLenght(null);
        $this->assertTrue(true);
    }

    public function testStrCanNullAndMaxLenthWhenValueIsEmpty()
    {
        DomainValidation::strCanNullAndMaxLenght('');
        $this->assertTrue(true);
    }

    public function testStrCanNullAndMaxLenthWhenValueNotNullAndLongerTheMaxLengthDefaultMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('The length must not me grater then 255 characters');
        DomainValidation::strCanNullAndMaxLenght(str_pad('A', 256));
    }

    public function testStrCanNullAndMaxLenthWhenValueNotNullAndLongerTheMaxLengthCustomMessage()
    {
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('custom message');
        DomainValidation::strCanNullAndMaxLenght(str_pad('A', 11), 10, 'custom message');
    }

    public function testStrCanNullAndMaxLenthWhenValueNotNullAndLessTheMaxLength()
    {
        DomainValidation::strCanNullAndMaxLenght(str_pad('A', 9), 10);
        $this->assertTrue(true);
    }
}
