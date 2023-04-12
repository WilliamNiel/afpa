<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Visibilite;
use App\Models\Etat;
use Carbon\Carbon;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('etat_id', 2)->paginate(5);
        return view('news.index', compact('news'));
    }

    public function indexAdmin()
    {
        $news = News::paginate(6);
        return view('news.indexAdmin', compact('news'));
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
        return view('news.formNews', compact('visibilites', 'etats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
        } else {
            $path = 'public/images/defaultNews.png';
        }

        News::create([
            'titre' => $request->titre,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'sujet' => $request->sujet,
            'image' => $path,
            'contenu' => strip_tags($request->contenu),
            'visibilite_id' => $visibilite_id,
            'etat_id' => $etat_id
        ]);
        return redirect()->route('news.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $new = News::findOrFail($id);
        return view('news.new', compact('new'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visibilites = Visibilite::all();
        $etats = Etat::all();
        $new = News::findOrFail($id);
        return view('news.formNews', compact('new', 'visibilites', 'etats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
{
    $news = News::findOrFail($id);
    
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

    $path = $news->image;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = $image->store('public/images');
    }

    $news->update([
        'titre' => $request->titre,
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'sujet' => $request->sujet,
        'image' => $path,
        'contenu' => strip_tags($request->contenu),
        'visibilite_id' => $visibilite_id,
        'etat_id' => $etat_id
    ]);
    
    return redirect()->route('news.admin.index');
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $new = News::findOrFail($id);
        $new->delete();

        return redirect()->route('news.admin.index');
    }
}
