<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Article;
use App\Image;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::search($request->title)->orderBy('id', 'ASC')->paginate(5);
        $articles->each(function($articles){
            $articles->category;
            $articles->user;
        });
        return view('admin.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tag = Tag::orderBy('name', 'ASC')->pluck('name', 'id');
        return view('admin.articles.create', compact('categories', 'tag'));
                    // ->with(compact('categories'))
                    // ->with(compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        // dd("hola s");

        // Manipulación de imagenes
            if ($request->file('image')) {

                $article = new Article($request->all());
                $article->user_id = \Auth::user()->id;
                $article->save();
                $article->tags()->sync($request->tags);
                foreach ($request->image as $key => $value) {

                    // dd($request->file('image'));
                    $nameUser = \Auth::user()->name;
                    // dd($nameUser);
                    $file = $request->file('image')[$key];

                    // $name = 'blogimage' . time() . '.' . $file->getClientOriginalExtension();
                    $name = 'blogimage' . $file->getClientOriginalName();
                    $path = public_path() . '/images' . '/' . $nameUser;
                    $file->move($path, $name);

                    $image = new Image();
                    $image->name=$name;
                    $image->article()->associate($article);
                    $image->save();
                }
            }


        // $article = new Article($request->all());
        // $article->user_id = \Auth::user()->id;
        // $article->save();
        //     // dd($nameImages);
        // $article->tags()->sync($request->tags);

        // $image = new Image();
        // foreach ($nameImages as $key => $value) {
            // $image->name=$nameImages[$key];
            // $image->article()->associate($article);
            // $image->save();
        // }
        flash('Se ha creado el articulo ' . "<b>".$article->title."</b>" . ' de forma exitosamente!!')->success()->important();
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $article->category;
        $categories = Category::orderBy('name', 'DESC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'DESC')->pluck('name', 'id');

        $my_tags = $article->tags->pluck('id')->ToArray();

        return view('admin.articles.edit', compact('article', 'tags', 'categories', 'my_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();

        $article->tags()->sync($request->tags);
        flash('Se ha editado el articulo ' . "<b>".$article->title."</b>" . ' de forma exitosamente!!')->success()->important();
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        flash('El articulo ' . '<b>' . $article->title  . '</b>' . ' ha sido eliminado exitosamente')->important(); //uso de flash para mostrar mensaje.
        return redirect()->route('articles.index');
    }
}
