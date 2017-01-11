<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{


    const DEFAULT_NEW_PRODUCTS_COUNT = 3;

    const DEFAULT_TOP_SALES_PRODUCTS_COUNT = 3;

    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function getAllProducts(Request $request)
    {
        return Product::with('images', 'descriptions', 'manufacturer')->paginate(5);
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
