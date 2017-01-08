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

    public function GetProductsByCategory($categoryId)
    {
        $category = ProductCategory::find($categoryId);
        $products = DB::table('clk_1d21ac51df_product')
            ->join('clk_1d21ac51df_category_product', 'clk_1d21ac51df_product.id_product', '=', 'clk_1d21ac51df_category_product.id_product')
            ->select('clk_1d21ac51df_product.*', 'clk_1d21ac51df_category_product.id_category')
            ->where('id_category', $categoryId)
            ->paginate();
        return response()->json([
            'products' => $products,
            'category' => $category
        ]);
    }

    public function getNewProducts(Request $request)
    {
        if (Auth::check()) {
            return Auth::user();
        }
        $numberOfProducts = $request->get('number') ? $request->get('number'): 3;
        $products = DB::table('clk_1d21ac51df_product')
            ->orderBy('date_add', 'desc')
            ->take($numberOfProducts)
            ->get();
        return response()->json([
            'products' => $products
        ]);
    }
}
