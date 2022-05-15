<?php

namespace Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;


class CategoryUnitTest extends TestCase
{

    public function testAttributes()
    {
        $category = new Category(
            name: 'test name',
            description: 'test description',
            isActive: true,
        );

        $this->assertNotEmpty($category->createdAt());
        $this->assertNotEmpty($category->id());
        $this->assertEquals('test name', $category->name);
        $this->assertEquals('test description', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'test name',
            isActive: false
        );

        $this->assertTrue($category->isActive);
        $this->assertFalse($category->isActive);
        $category->active();
        $this->assertTrue($category->isActive);
    }

    public function testDisabled()
    {
        $category = new Category(
            name: 'test name',
            isActive: true
        );

        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'test name',
            description: 'test description',
            isActive: true,
            createdAt: '2023-01-01 12:12:12'
        );

        $category->update(
            name: 'new name',
            description: 'new description',
        );

        $this->assertEquals($uuid, $category->id());
        $this->assertEquals('new name', $category->name);
        $this->assertEquals('new description', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testExceptionNameNotValid()
    {
        $this->expectException(EntityValidationException::class);
        new Category(
            name: 'aa',
            description: 'test description',
        );
    }

    public function testExceptionDescriptionNotValid()
    {
        $this->expectException(EntityValidationException::class);
        new Category(
            name: 'valid name',
            description: str_pad('A', 256),
        );
    }
}
