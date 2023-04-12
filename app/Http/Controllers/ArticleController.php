<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Visibilite;
use App\Models\Etat;
use Carbon\Carbon;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('etat_id', 2)->get();
        return view('articles.agenda', compact('articles'));
    }

    public function indexAdmin()
    {
        $articles = Article::paginate(8);
        return view('articles.indexAdmin', compact('articles'));
    }

    /**s
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visibilites = Visibilite::all();
        $etats = Etat::all();
        return view('articles.formArticle', compact('visibilites', 'etats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        try{
            DB::connection()->getPdo();
            $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d');
            $date_fin = Carbon::parse($request->date_fin)->format('Y-m-d');
            $visibilite_id = $request->input('visibilite_id');
            $etat_id = $request->input('etat_id');

            $request->validate([
                'titre' => 'required|max:50',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_debut',
                'sujet' => 'required',
                'contenu' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('public/images');
            } else {
                $path = 'public/images/defaultAgenda.png';
            }
    
            
            Article::create([
                'titre' => $request->titre,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
                'sujet' => $request->sujet,
                'image' => $path,
                'contenu' => strip_tags($request->contenu),
                'visibilite_id' => $visibilite_id,
                'etat_id' => $etat_id
            ]);
            return redirect()->route('articles.admin.index');
        }catch(\Exception $e){
            return redirect()->route('articles.admin.index')
            ->with("error", "Désolé, la base de donnée n'est pas disponible.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $article = Article::findOrFail($id);
        return view('articles.article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visibilites = Visibilite::all();
        $etats = Etat::all();
        $article = Article::findOrFail($id);
        return view('articles.formArticle', compact('article', 'visibilites', 'etats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticleRequest $request, Article $article)
    {
        $date_debut = Carbon::parse($request->date_debut)->format('Y-m-d');
        $date_fin = Carbon::parse($request->date_fin)->format('Y-m-d');
        $visibilite_id = $request->input('visibilite_id');
        $etat_id = $request->input('etat_id');

        $request->validate([
            'titre' => 'required|max:50',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'sujet' => 'required',
            'contenu' => 'required'
        ]);

        $article->titre = $request->titre;
        $article->date_debut = $date_debut;
        $article->date_fin = $date_fin;
        $article->sujet = $request->sujet;
        $article->contenu = strip_tags($request->contenu);
        $article->visibilite_id = $visibilite_id;
        $article->etat_id = $etat_id;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $article->image = $path;
        }

        $article->save();

        return redirect()->route('articles.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.admin.index');
    }
}
