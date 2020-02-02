<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->paginate(6);
        return view('posts', compact('posts', 'categories'));
    }

    public function details($slug)
    {

        $post = Post::where('slug', $slug)->first();

        $blogKey = 'blog_' . $post->id;

        if (!Session::has($blogKey))
        {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        if (Post::all()->count() <= 3){
            $randomposts = Post::all()->random(1);
        }
        else
        {
            $randomposts = Post::all()->random('3');
        }
        $categories = Category::all();
        Carbon::setLocale('ru');

        return view('post', compact('post', 'randomposts', 'categories'));
    }

    public function postByCategory($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->published()->get();
        return view('category', compact('category', 'categories', 'posts'));
    }

    public function postByTag($slug)
    {
        $categories = Category::all();
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->approved()->published()->get();
        return view('tag', compact('tag', 'categories', 'posts'));
    }

    public function view($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->published()->get();
        return view('category', compact('category', 'categories', 'posts'));
    }

}
