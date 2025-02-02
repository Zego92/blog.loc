<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->approved()->published()->take(6)->get();
        $categories = Category::all();
        return view('welcome', compact('categories', 'posts'));
    }

    public function contact()
    {
        $categories = Category::all();
        return view('contact', compact('categories'));
    }
}
