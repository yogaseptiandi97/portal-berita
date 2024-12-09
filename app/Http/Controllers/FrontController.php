<?php

namespace App\Http\Controllers;

use App\Models\AdsBanner;
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
        ->where('is_featured', '0')
        ->latest()
        ->take(3)
        ->get();

        $featured = Article::with(['category'])
        ->where('is_featured', 1)
        ->inRandomOrder()
        ->take(3)
        ->get();

        $authors = Author::all();

        $ads = AdsBanner::where('is_active', 'active')
        ->inRandomOrder()
        ->first();

        $category_articles = Article::whereHas('category', function ($query){
            $query->where('name', 'idoru');
        })
        // ->where('is_featured', 0)
        ->latest()
        ->take(6)
        ->get();

        $category_lists = Category::with('article')->get();
        // $category_featured_lists = Category::with(['article' => function ($query) {
        //     $query->orderByDesc('is_featured')->orderBy('created_at', 'desc');
        // }])->get();
        // $category_featured_lists = Category::with(['article' => function ($query) {
        //     $query->where('is_featured', 1);
        // }])
        // ->inRandomOrder()
        
        $category_featured_lists = Article::with(['category'])
        ->where('is_featured', 1)
        ->inRandomOrder()
        ->first();
        $category_nonfeatured_lists = Article::with('category')
        ->where('is_featured', '0')
        ->latest()
        ->take(6)
        ->get();
        $nonfeatured_articles = Article::with(['category'])
        ->where('is_featured', '0')
        ->latest()
        ->take(3)
        ->get();

        return view('front.index',compact('categories', 'articles', 'featured', 'authors', 'ads', 'category_articles', 'category_lists', 'category_featured_lists', 'category_nonfeatured_lists', 'nonfeatured_articles'));
    }
}
