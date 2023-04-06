<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ isset($article) ? route('articles.update', ['article' => $article->id]) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($article))
                @method('PUT') 
            @endif
            <input type="hidden" name="article_id" value="{{ isset($article->id) ? $article->id : '' }}">
            <p><label>TITRE</label>
                <input type="text" name="titre" id="titre" value="{{ isset($article->titre) ? $article->titre : '' }}">
            </p>
            <p><label>SUJET</label>
                <input type="text" name="sujet" id="sujet" value="{{ isset($article->sujet) ? $article->sujet : '' }}">
            </p>

            <p><label>VISIBILITE:</label>
                <select name="visibilite_id">
                    @foreach($visibilites as $visibilite)
                    <option value="{{ $visibilite->id }}" {{ $visibilite->id == old('visibilite_id', $article->visibilite_id ?? '') ? 'selected' : '' }}>
                        {{ $visibilite->nom_visibilite }}
                    </option>
                    @endforeach
                </select>

                <label>ETAT:</label>
                <select name="etat_id">
                    @foreach($etats as $etat)
                    <option value="{{ $etat->id }}" {{ $etat->id == old('etat_id', $article->etat_id ?? '') ? 'selected' : '' }}>
                        {{ $etat->nom_etat }}
                    </option>
                    @endforeach
                </select>
            </p>

            <label for="date_debut">Date de début :</label>
            <input type="date" id="date_debut" name="date_debut" value="{{ isset($article->date_debut) ? $article->date_debut : '' }}"></input>

            <label for="date_fin">Date de fin :</label>
            <input type="date" id="date_fin" name="date_fin" value="{{ isset($article->date_fin)  ? $article->date_fin : '' }}"></input><br>



                <label>CONTENUE</label><br>
                <textarea class="ckeditor form-control" id="contenu" name="contenu">{{ isset($article->contenu) ? $article->contenu : '' }}</textarea>


            <p><label>UPLOAD IMAGE</label>
                <input type="file" name="image"></input>
                @if(isset($article->image))
                <img src="{{ asset('storage/' . $article->image) }}" alt="Ma super image">
                @endif
            </p>

            <button type="submit">Valider</button>
            <button>Annuler</button>
        </form>
    </div>

</body>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
</html>