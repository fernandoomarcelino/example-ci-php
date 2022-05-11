<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;
use Exception;

class Category
{
    use MethodsMagicsTrait;

    protected Uuid $id;
    protected DateTime $createdAt;

    /**
     * @throws Exception
     */
    public function __construct(
        string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
        string $createdAt = '',
    ) {
        $this->id = $id ? new Uuid($id) : Uuid::random();
        $this->createdAt = $createdAt ? new DateTime($createdAt) : new DateTime();

        $this->validate();
    }

    public function active()
    {
        $this->isActive = true;
    }

    public function disable()
    {
        $this->isActive = false;
    }

    public function update(string $name, string $description = '')
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    /**
     * @throws EntityValidationException
     */
    private function validate()
    {
        DomainValidation::notNull($this->name);
        DomainValidation::strMinLenght($this->name);
        DomainValidation::strMaxLenght($this->name);
        DomainValidation::strCanNullAndMaxLenght($this->description);
    }
}
