<?php

namespace App\Http\Controllers;

use App\Model\Product;
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

        $search = [];
        if ($request->get('name')) {
            $search['name'] = $request->get('name');
        }
        if ($request->get('description')) {
            $search['description'] = $request->get('description');
        }

        return Product::search($search, $limit);

    }

    public function getById(Product $product)
    {
        return $product;
    }

    public function getProductsByCategory(Request $request, $categoryId)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_PAGINATION_LIMIT;

        return Product::byCategory($categoryId, $limit);
    }

    public function getNewProducts(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_NEW_PRODUCTS_COUNT;

        return Product::new($limit);
    }

    public function getTopSalesProducts(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_TOP_SALES_PRODUCTS_COUNT;

        return  Product::TopSales($limit);
    }

    public function getSpecialOffers(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_TOP_SALES_PRODUCTS_COUNT;

        return  Product::specialOffers($limit);
    }
}
