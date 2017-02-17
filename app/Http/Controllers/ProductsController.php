<?php

namespace App\Http\Controllers;

use App\Model\Attribute\AttributeGroup;
use App\Model\Product;
use Illuminate\Http\Request;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 * @resource Product
 */
class ProductsController extends Controller
{
    const DEFAULT_NEW_PRODUCTS_COUNT = 3;

    const DEFAULT_TOP_SALES_PRODUCTS_COUNT = 3;

    const DEFAULT_PAGINATION_LIMIT = 5;

    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    /**
     * Get all products with limit(default: 5)
     * @param Request $request
     * @return mixed
     */
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

    /**
     * Get product
     * @param Product $product
     * @return Product
     */
    public function getById(Product $product)
    {
        return $product;
    }

    /**
     * Get product attributes
     * @param Product $product
     * @return mixed
     */
    public function getAttributeById(Product $product){
        return [ 'data'=>AttributeGroup::AttributebyProduct($product->id_product)->get()];
    }

    /**
     * Get products by Category  with limit(default: 5)
     * @param Request $request
     * @param $categoryId
     * @return mixed
     */
    public function getProductsByCategory(Request $request, $categoryId)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_PAGINATION_LIMIT;

        return Product::byCategory($categoryId, $limit);
    }

    /**
     * Get new products  with limit(default: 3)
     * @param Request $request
     * @return mixed
     */
    public function getNewProducts(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_NEW_PRODUCTS_COUNT;

        return Product::new($limit);
    }

    /**
     * Get top Sales products  with limit(default: 3)
     * @param Request $request
     * @return mixed
     */
    public function getTopSalesProducts(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_TOP_SALES_PRODUCTS_COUNT;

        return Product::TopSales($limit);
    }

    /**
     * Get special products with limit(default: 3)
     * @param Request $request
     * @return mixed
     */
    public function getSpecialOffers(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_TOP_SALES_PRODUCTS_COUNT;

        return Product::specialOffers($limit);
    }
}
