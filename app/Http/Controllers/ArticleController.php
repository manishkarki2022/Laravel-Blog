<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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
}
