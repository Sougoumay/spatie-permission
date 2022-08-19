<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //$this->authorize('viewAny',Article::class);
        Gate::authorize('read articles', Article::class);
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        Gate::authorize('publish articles');
        return view('articles.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //$this->authorize('create',Article::class);
        Gate::authorize('publish articles', Article::class);
        $validate = $request->validate([
            'title'=>'string|required|min:3',
            'description'=>'string|required|min:10',
            'content'=>'string|required|min:25'
        ]);
        //dd($validate);
        auth()->user()->articles()->create($validate);

        return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Article $article)
    {
        //$this->authorize('view',Article::class);
        Gate::authorize('read articles',Article::class);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Article $article)
    {
        //$this->authorize('update',$article);
        Gate::authorize('edit articles', Article::class);
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        //$this->authorize('update',$article);
        Gate::authorize('edit articles', Article::class);
        $validate = $request->validate([
            'title'=>'string|min:3',
            'description'=>'string|min:10',
            'content'=>'string|min:25'
        ]);
        $article->update($validate);
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        //$this->authorize('delete',$article);
        Gate::authorize('delete articles');
        $article->delete();
        return redirect()->route('articles.index');
    }
}
