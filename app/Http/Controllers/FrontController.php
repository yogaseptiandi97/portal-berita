<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $categories = Category::all();

        $articles = Article::with(['category'])
        ->where('is_featured', 2)
        ->latest()
        ->take(3)
        ->get();

        $featured = Article::with(['category'])
        ->where('is_featured', 1)
        ->latest()
        ->take(3)
        ->get();

        $authors = Author::all();


        return view('front.index',compact('categories', 'articles', 'featured'));
    }
}
