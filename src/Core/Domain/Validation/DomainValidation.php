<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(?string $value, string $exceptionMessage = null)
    {
        if (empty($value)) {
            throw new EntityValidationException($exceptionMessage ?? 'should not be empty');
        }
    }

    public static function strMaxLenght(?string $value, int $maxLength = 255, string $exceptionMessage = null)
    {
        if (strlen($value ?? '') > $maxLength) {
            throw new EntityValidationException($exceptionMessage ?? "The length must not me grater then {$maxLength} characters");
        }
    }

    public static function strMinLenght(?string $value, int $minLength = 3, string $exceptionMessage = null)
    {
        if (strlen($value ?? '') < $minLength) {
            throw new EntityValidationException($exceptionMessage ?? "The length must not at least {$minLength} characters");
        }
    }

    public static function strCanNullAndMaxLenght(?string $value = '', int $maxLength = 255, string $exceptionMessage = null)
    {
        if (!empty($value) && strlen($value) > $maxLength) {
            throw new EntityValidationException($exceptionMessage ?? "The length must not me grater then {$maxLength} characters");
        }
    }
}
