<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts', compact('posts'));
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

//        $randomposts = Post::all()->random(3);
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

}
