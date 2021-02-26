<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
    public function index(Post $post)
    {
        
        $categories = Category::get();
        $posts = $post->latest()->limit(6)->get();
        // return view('blog',compact('posts'));
        return view('frontend.frontpage', compact('posts', 'categories'));
    }

    public function detail($slug)
    {
        $categories = Category::get();
        $post = Post::where('slug', $slug)->first();
        return view('frontend.detailpage', compact('post', 'categories'));
    }

    public function listPost()
    {
        $categories = Category::get();
        $posts = Post::latest()->paginate(6);
        return view('frontend.postlist', compact('posts', 'categories'));
    }

    public function category(Category $category)
    {

        $categories = Category::get();
        $category = $category->posts()->paginate(6);
        return view('frontend.categorylist', compact('category', 'categories'));
    }

    public function allCategories()
    { }

    public function search(Request $request)
    {
        $categories = Category::get();

        $posts = Post::where('title', 'like', '%'. $request->search.'%')->paginate(6);
        return view('frontend.postlist', compact('posts', 'categories'));
    }
}
