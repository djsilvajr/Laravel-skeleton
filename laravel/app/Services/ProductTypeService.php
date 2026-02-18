<?php

namespace App\Services;

use App\Services\ProductType\GetProductTypes;

class ProductTypeService
{
    public function __construct(
        private GetProductTypes $getProductTypes
    ) {}

    public function getProductTypes(): array
    {
        return $this->getProductTypes->execute();
    }
}