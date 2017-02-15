<?php

namespace App\Http\Controllers;

use App\Model\Blog\Post;
use Illuminate\Http\Request;

/**
 * Class PostsController
 * @package App\Http\Controllers
 * @resource Blog Post
 */
class BlogPostController extends Controller
{
    const DEFAULT_PAGINATION_LIMIT = 5;


    /**
     * Get post by id
     * @param Post $post
     * @return Post
     */
    public function getById(Post $post)
    {
        $post->viewed++;
        $post->save();
        return $post;
    }

    /**
     * Get posts by Category  with limit(default: 5)
     * @param Request $request
     * @param $categoryId
     * @return array
     */
    public function getPostsByCategory(Request $request, $categoryId)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_PAGINATION_LIMIT;

        return Post::byCategory($categoryId, $limit);
    }

    /**
     * Get posts with limit(default: 5)
     * @param Request $request
     * @return array
     */
    public function getNewPosts(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : self::DEFAULT_PAGINATION_LIMIT;

        return Post::new($limit);
    }


}
