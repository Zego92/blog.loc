<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $categories = Category::all();
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%$query%")->approved()->published()->get();
        return view('search', compact('posts', 'query', 'categories'));
    }
}
