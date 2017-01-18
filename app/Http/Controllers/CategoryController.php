<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return Category::home();
    }

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
