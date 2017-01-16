<?php

namespace App\Http\Controllers;

use App\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::getAllCategories();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::getCategoryById($id);
        if(!$category){
            throw new NotFoundHttpException();
        }
        return response()->json($category);
    }
}
