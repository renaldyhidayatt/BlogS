<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Tag;

class PostsController extends Controller
{
    public function show(Posts $post)
    {
        return view('blog.show')->with('posts', $post);
    }
    public function category(Category $category){
        return view('blog.category')
        ->with('category', $category)
        ->with('posts', $category->posts()->searched()->simplePaginate(3))
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }
    public function tag(Tag $tag){
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $tag->posts()->searched()->simplePaginate(3));
    }
}
