<?php

namespace App\Services\ProductType;

use App\Exceptions\ResourceNotFoundException;
use App\Repository\Contracts\ProductTypeInterface;

class GetProductTypes
{
    public function __construct(
        private ProductTypeInterface $productTypeRepository
    ) {
        
    }

    public function execute() : array
    {
        $productTypes = $this->productTypeRepository->getAllProductTypes();

        if(empty($productTypes)) {
            throw new ResourceNotFoundException("Types of products not found.");
        }

        return $productTypes;
    }
}