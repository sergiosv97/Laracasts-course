<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        if (request('tag')) {
            $articles = Tag::where('name',request('tag'))->firstOrFail()->articles;
        }else {
            $articles = Article::latest()->get();
        }
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
        
        return view('articles.create',[
            'tags'=> Tag::all()
        ]);
    
    }

    public function store()
    {
        $this->validateArticle();
        //dd(request()->all());
        $article = new Article(request(['title','excerpt','body']));
        $article->user_id = 1; 
        $article->save();

        $article->tags()->attach(request('tags'));
        
        //persist the new resource
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

    protected function validateArticle()
    {
        return request()->validate([
            'title'=> 'required',
            'excerpt'=> 'required',
            'body'=> 'required',
            'tags'=> 'exists:tags,id'
        ]);
    }

    public function destroy()
    {
        //delete the resource
    
    }
}
