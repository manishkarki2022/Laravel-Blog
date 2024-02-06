<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user','tags'])->latest()->paginate(10);
        return view('articles.index',compact('articles'));

    }
    public function show(Article $article)
    {
        return view('articles.show',compact('article'));
    }
    public function create()
    {
        $categories = Category::pluck('name','id');
        $tags = Tag::pluck('name','id');
        return view('articles.create',compact('categories','tags'));
    }
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'description' => $request->description,
            'status' => $request->status === 'on',
            'user_id' => auth()->id(),
            'category_id' => $request->category_id
        ]);
        $article->tags()->attach($request->tags);
        return redirect()->route('articles.index')
             ->with('message','Article Created Successfully');


    }
}
