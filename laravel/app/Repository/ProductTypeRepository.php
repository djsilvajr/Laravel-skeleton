<?php

namespace App\Repository;

use App\Repository\Contracts\ProductTypeInterface;
use App\Exceptions\PersistenceErrorException;

use Illuminate\Support\Facades\DB;

class ProductTypeRepository implements ProductTypeInterface
{
    public function getAllProductTypes(): array
    {
        $productTypes = [];

        try {
            $productTypes = DB::table('product_types')
                ->select('id', 'name', 'slug', 'description', 'order', 'icon', 'image_url', 'active', 'created_at', 'updated_at')
                ->where('parent_id', null)
                ->get()
                ->toArray();

        } catch (\Throwable $th) {
            throw new PersistenceErrorException();
        }

        return $productTypes;
    }
}