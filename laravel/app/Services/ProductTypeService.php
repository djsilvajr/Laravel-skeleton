<?php

namespace App\Services;

use App\Services\ProductType\GetProductTypes;
use App\Services\ProductType\GetProductTypeById;

class ProductTypeService
{
    public function __construct(
        private GetProductTypes $getProductTypes,
        private GetProductTypeById $getProductTypeById
    ) {}

    public function getProductTypes(): array
    {
        return $this->getProductTypes->execute();
    }

    public function getProductTypeById(int $id): array
    {
        return $this->getProductTypeById->execute($id);
    }
}