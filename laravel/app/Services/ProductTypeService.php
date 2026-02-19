<?php

namespace App\Services;

use App\Services\ProductType\GetProductTypes;
use App\Services\ProductType\GetProductTypeById;
use App\Services\ProductType\GetChildProductTypesById;

class ProductTypeService
{
    public function __construct(
        private GetProductTypes $getProductTypes,
        private GetProductTypeById $getProductTypeById,
        private GetChildProductTypesById $getChildProductTypesById
    ) {}

    public function getProductTypes(): array
    {
        return $this->getProductTypes->execute();
    }

    public function getProductTypeById(int $id): array
    {
        return $this->getProductTypeById->execute($id);
    }

    public function getChildProductTypesById(int $id): array
    {
        return $this->getChildProductTypesById->execute($id);
    }
}