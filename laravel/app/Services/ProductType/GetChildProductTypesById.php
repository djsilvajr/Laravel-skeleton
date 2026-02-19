<?php


namespace App\Services\ProductType;

//use App\Exceptions\ResourceNotFoundException;
use App\Repository\Contracts\ProductTypeInterface;
use App\Services\ProductType\Rules\ProductTypeMustExist;

class GetChildProductTypesById
{
    public function __construct(
        private ProductTypeInterface $productTypeRepository,
        private ProductTypeMustExist $productTypeMustExist
    ) {
        
    }

    public function execute(int $id) : array
    {
        $this->productTypeMustExist->validate($id);

        $return = [
            'product_type' => [],
            'child_product_types' => []
        ];

        $productType = $this->productTypeRepository->findProductTypeById($id);
        $return['product_type'] = (array) current($productType);

        $childProductTypes = $this->productTypeRepository->findChildProductTypesById($id);
        $return['child_product_types'] = $childProductTypes ?? [];

        return $return;
    }
}