<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $products = Product::paginate();

        return response()->json([
            'products' => $products
        ]);
    }

    public function getProductsByCategory($categoryId)
    {
        $category = ProductCategory::find($categoryId);
        $products = Product::getProductsByCategory($categoryId)->paginate();

        return response()->json([
            'products' => $products,
            'category' => $category
        ]);
    }

    public function getNewProducts(Request $request)
    {
        $numberOfProducts = $request->get('number') ? $request->get('number'): self::DEFAULT_NEW_PRODUCTS_COUNT;
        $products = Product::getNewProducts($numberOfProducts);

        return response()->json([
            'products' => $products
        ]);
    }

    public function getTopSalesProducts(Request $request)
    {
        $numberOfProducts = $request->get('number') ? $request->get('number'): self::DEFAULT_TOP_SALES_PRODUCTS_COUNT;
        $products = Product::getTopSalesProducts($numberOfProducts);

        return response()->json([
            'products' => $products
        ]);
    }
}
