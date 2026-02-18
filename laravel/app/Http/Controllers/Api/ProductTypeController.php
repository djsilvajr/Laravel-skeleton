<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ProductTypeService;

class ProductTypeController extends Controller
{
    protected $productTypeService;

    public function __construct(ProductTypeService $productTypeService)
    {
        $this->productTypeService = $productTypeService;
    }

    public function getProductTypes()
    {
        $productTypes = $this->productTypeService->getProductTypes();

        return response()->json([
            'status' => true,
            'message' => 'Product types fetched successfully.',
            'errors' => [],
            'data' => $productTypes,
            '_links' => [
                'self' => [
                    'href' => url('product/types'),
                ],
            ]
        ]);
    }
}
