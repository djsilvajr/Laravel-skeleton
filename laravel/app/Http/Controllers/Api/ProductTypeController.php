<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\GetProductTypeByIdRequest;

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
                    'href' => url('v1/product/types'),
                ],
                'GET' => [
                    'href' => url('v1/product/type/{id}')
                ],
            ]
        ]);
    }

    public function getProductTypeById($id, Request $request)
    {
        //$credentials = $request->only(['']);
        $credentials = [];
        $credentials = array_merge($credentials, ['id' => $id]);

        GetProductTypeByIdRequest::validate($credentials);

        $productType = $this->productTypeService->getProductTypeById($id);

        return response()->json([
            'status' => true,
            'message' => 'Product type fetched successfully.',
            'errors' => [],
            'data' => $productType,
            '_links' => [
                'self' => [
                    'href' => url("v1/product/type/{$id}"),
                ],
                'GET_ALL' => [
                    'href' => url('v1/product/types')
                ],
            ]
        ]);
    }
}
