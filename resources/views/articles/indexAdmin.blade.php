<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="{{ route('articles.create')}}"><button>Ajouter</button></a>
<table>
<tr>

    <th>TITRE</th>
    <th>ETAT</th>
    <th>DATE DE DEBUT</th>
    <th>DATE DE FIN</th>
    <th></th>
    <th></th>
</tr>
@foreach($articles as $article)
<tr>
 <td>{{$article->titre}}</td>
<td>{{$article->etat->nom_etat}}</td>
<td> {{$article->date_debut}}</td>
<td> {{$article->date_fin}}</td>
<td><a href="{{ route('articles.edit', ['article' => $article->id]) }}"><button>Modifier</button></a></td>
<td>
    <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="confirmDelete(event)">Supprimer</button>
        </form>
</td>
</tr>

@endforeach
</table>
</table>
</div>
</body>
<script>
function confirmDelete() {
  if (window.confirm("Confirmer la suppression")) {
 
  } else {
    event.preventDefault();
  }
}
</script>
</html>