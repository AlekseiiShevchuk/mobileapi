<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

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
        $numberOfProducts = $request->get('number') ? $request->get('number'): 3;
        $products = Product::getNewProducts($numberOfProducts);
        return response()->json([
            'products' => $products
        ]);
    }

    public function getTopSalesProducts(Request $request)
    {
        $numberOfProducts = $request->get('number') ? $request->get('number'): 3;
        $products = Product::getTopSalesProducts($numberOfProducts);
        return response()->json([
            'products' => $products
        ]);
    }
}
