<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
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
        return view('articles.create',$this->getFormData());
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
    public function edit(Article $article)
    {
        return view('articles.edit',array_merge(compact('article'),
            $this->getFormData()));
    }
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->validated() + [
                'slug' => Str::slug($request->title)]);

        $article->tags()->sync($request->tags);

        return redirect(route('dashboard'))->with('message', 'Article has successfully been updated');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect(route('dashboard'))->with('message', 'Article has successfully been deleted.');
    }




    public function getFormData()
    {
        $categories = Category::pluck('name','id');
        $tags = Tag::pluck('name','id');
        return compact('categories', 'tags');
    }
}
