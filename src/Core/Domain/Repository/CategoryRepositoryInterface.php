<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;
    public function findById(string $categoryId): Category;
    public function findByAll();
    public function paginate();
    public function update(Category $category): Category;
    public function delete(string $categoryId): bool;
    public function toCategory(object $data): Category;
}
