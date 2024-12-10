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

    public function category(Category $category){
        $categories = Category::all();
        $ads = AdsBanner::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();
        return view('front.category', compact('category', 'categories', 'ads'));
    }

    public function author(Author $author){
        $categories = Category::all();

        $ads = AdsBanner::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();
        return view('front.author', compact('categories', 'author','ads'));
    }

    public function search(Request $request){
        $request->validate([
            'keyword' => ['required', 'string', 'max:255'],
        ]);

        $categories = Category::all();

        $keyword = $request->keyword;

        $articles = Article::with(['category', 'author'])
        ->where('name', 'like', '%'.$keyword.'%')->paginate(6);

        return view('disfrontplay.search', compact('articles', 'keyword', 'categories'));
    }

    public function details(Article $article){
        $categories = Category::all();
        
        $articles = Article::with(['category'])
        ->where('is_featured', '0')
        ->where('id', '!=', $article->id)
        ->latest()
        ->take(3)
        ->get();

        $ads = AdsBanner::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        ->first();

        $author_articles = Article::where('author_id', $article->author_id)
        ->where('id', '!=', $article->id)
        ->inRandomOrder()
        ->take(3)
        ->get();

        return view('front.details', compact('article', 'author_articles', 'categories', 'articles', 'ads'));
    }
}
