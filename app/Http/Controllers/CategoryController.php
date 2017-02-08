<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 * @resource Category
 */
class CategoryController extends Controller
{
    /**
     * Root Menu Category
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return ['data'=>Category::home()];
    }

    /**
     * Get category with subcategory(depth)
     * @param Request $request
     * @param Category $category
     * @return $this|Category
     */
    public function getById(Request $request,Category $category)
    {
        $dept = $request->get('dept') ? $request->get('dept') : 0;

        if($dept > 0) {
            $data = $category->load(['children' => function ($query) use ($dept) {
                Category::getSub($query, $dept - 1);
                $query->where('active', '=', 1);
            }]);
        }else{
            $data = $category;
        }

        return $data;
    }
}
