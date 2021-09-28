<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        //render a list of resource
        $articles = Article::latest()->get();

        return view('articles.index',['articles' => $articles ]);
    }

    public function show(Article $article)
    {
        //show a single resource
        //$article = Article::findOrFail($id);

        return view('articles.show',['article' => $article ]);
    }

    public function create()
    {
        //shows a view to create a new resource
        return view('articles.create');
    
    }

    public function store()
    {
        Article::create($this->validateArticle());
        //persist the new resource
        //dump(request()->all());

        //validation 

        //clean up
        return redirect(route('articles.index'));
    
    }

    public function edit(Article $article)
    {
        //$article = Article::find($id);
        //show a view to edit an existing resource
        //find the article associated with the id
        return view('articles.edit', compact('article'));
    
    }

    public function update(Article $article)
    {
        $article->update($this->validateArticle());
        
        //$article = Article::find($id);
        //show a view to edit an existing resource
        //find the article associated with the id
        return redirect($article->path());
    }

    public function destroy()
    {
        //delete the resource
    
    }
}
