<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

        <form action="{{ isset($new) ? route('news.update', ['new' => $new->id]) : route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($new))
            @method('PUT')
            @endif
            <input type="hidden" name="new_id" value="{{ isset($new->id) ? $new->id : '' }}">
            <p><label>TITRE</label>
                <input type="text" name="titre" id="titre" value="{{ isset($new->titre) ? $new->titre : '' }}">
            </p>
            <p><label>SUJET</label>
                <input type="text" name="sujet" id="sujet" value="{{ isset($new->sujet) ? $new->sujet : '' }}">
            </p>

            <p><label>VISIBILITE:</label>
                <select name="visibilite_id">
                    @foreach($visibilites as $visibilite)
                    <option value="{{ $visibilite->id }}" {{ $visibilite->id == old('visibilite_id', $new->visibilite_id ?? '') ? 'selected' : '' }}>
                        {{ $visibilite->nom_visibilite }}
                    </option>
                    @endforeach
                </select>

                <label>ETAT:</label>
                <select name="etat_id">
                    @foreach($etats as $etat)
                    <option value="{{ $etat->id }}" {{ $etat->id == old('etat_id', $new->etat_id ?? '') ? 'selected' : '' }}>
                        {{ $etat->nom_etat }}
                    </option>
                    @endforeach
                </select>
            </p>

            <label for="date_debut">Date de début :</label>
            <input type="date" id="date_debut" name="date_debut" value="{{ isset($new->date_debut) ? $new->date_debut : '' }}"></input>

            <label for="date_fin">Date de fin :</label>
            <input type="date" id="date_fin" name="date_fin" value="{{ isset($new->date_fin)  ? $new->date_fin : '' }}"></input><br>



            <label>CONTENUE</label><br>
            <textarea class="ckeditor form-control" id="contenu" name="contenu">{{ isset($new->contenu) ? $new->contenu : '' }}</textarea>


            <p><label>UPLOAD IMAGE</label>
                <input type="file" name="image"></input>
                @if(isset($new->image))
                <img src="{{ Storage::url($new->image) }}" alt="Mon image">
                @endif
            </p>

            <button type="submit">Valider</button>
            <button>Annuler</button>
        </form>
    </div>

</body>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.config.entities = false;
        CKEDITOR.config.entities_latin = false;
        CKEDITOR.config.entities_greek = false;
        CKEDITOR.config.entities_processNumerical = false;
        CKEDITOR.config.forceSimpleAmpersand = true;
        CKEDITOR.config.htmlEncodeOutput = false;
        CKEDITOR.config.entities_additional = '';
        $('textarea.ckeditor').each(function() {
            CKEDITOR.replace($(this).attr('name'), {
                enterMode: CKEDITOR.ENTER_BR,
                allowedContent: true,
                entities: false
            });
        });
    });
</script>

</html>