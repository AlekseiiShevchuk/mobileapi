<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    const DEFAULT_NEW_PRODUCTS_COUNT = 3;

    const DEFAULT_TOP_SALES_PRODUCTS_COUNT = 3;

    const DEFAULT_PAGINATION_LIMIT = 5;

    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function getAllProducts(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_PAGINATION_LIMIT;

        $search =[];
        if($request->get('name')){
            $search['name'] = $request->get('name');
        }
        if($request->get('description')){
            $search['description'] = $request->get('description');
        }

        return Product::search($search,$limit);

    }

    public function getById(Product $product)
    {
        return $product->load('images', 'descriptions', 'manufacturer');
    }

    public function getProductsByCategory($categoryId)
    {
        return Product::getProductsByCategory($categoryId)->paginate(5);
    }

    public function getNewProducts(Request $request)
    {
        $numberOfProducts = $request->get('number') ? $request->get('number') : self::DEFAULT_NEW_PRODUCTS_COUNT;
        $products = Product::getNewProducts($numberOfProducts);

        return response()->json([
            'products' => $products
        ]);
    }

    public function getTopSalesProducts(Request $request)
    {
        $numberOfProducts = $request->get('number') ? $request->get('number') : self::DEFAULT_TOP_SALES_PRODUCTS_COUNT;
        $products = Product::getTopSalesProducts($numberOfProducts);

        return response()->json([
            'products' => $products
        ]);
    }
}
