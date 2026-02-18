<?php

namespace App\Repository\Contracts;

interface ProductTypeInterface
{
    public function getAllProductTypes(): array;
    public function findProductTypeById(int $id): array;
}