<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 2/15/17
 * Time: 3:27 PM
 */

namespace App\Http\Controllers;

use App\Model\Blog\Category;
use Illuminate\Http\Request;

/**
 * Class BlogCategoryController
 * @package App\Http\Controllers
 * @resource Blog Category
 *
 * image:
 * /modules/smartblog/images/category/{categoryID}{type}.jpg
 *
 * type not required
 *
 * '-home-default' -> 65x65
 *
 * '-home-small' -> 240x240
 *
 * '-single-default' -> 800x800
 *
 * without type is origin image
 */
class BlogCategoryController extends Controller
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