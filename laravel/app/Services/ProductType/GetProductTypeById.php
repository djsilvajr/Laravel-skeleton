<?php

namespace App\Services\ProductType;

use App\Exceptions\ResourceNotFoundException;
use App\Repository\Contracts\ProductTypeInterface;

use App\Services\ProductType\Rules\ProductTypeMustExist;

class GetProductTypeById
{
    public function __construct(
        private ProductTypeInterface $productTypeRepository,
        private ProductTypeMustExist $productTypeMustExist
    ) {
        
    }

    public function execute(int $id) : array
    {
        $this->productTypeMustExist->validate($id);

        $productType = $this->productTypeRepository->findProductTypeById($id);
        $productTypeArray = (array) current($productType);
        return $productTypeArray;
    }
}