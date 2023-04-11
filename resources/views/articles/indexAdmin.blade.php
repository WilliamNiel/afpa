<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>Document</title>
</head>

<body style="background-color: #19647E;">
  <div class="flex items-center justify-center flex-col h-screen gap-10">
    <div style="background-color: snow;" class="flex items-center justify-center gap-10 h-1/5 flex-col w-4/5 rounded-md text-3xl">
      <h2>Administration Agenda</h2>
    </div>
    <div style="background-color: snow;" class="flex items-center justify-center gap-10 h-3/5 flex-col w-4/5 rounded-md">
      <a href="{{ route('articles.create')}}" class="flex-start"><x-bouton-ajouter>Ajouter</x-bouton-ajouter></a>
      <table style="background-color: snow;" class="flex gap-10">
        <tr>
          <th class="border border-black border-solid rounded-md">TITRE</th>
          <th class="border border-black border-solid rounded-md">ETAT</th>
          <th class="border border-black border-solid rounded-md">DATE DE DEBUT</th>
          <th class="border border-black border-solid rounded-md">DATE DE FIN</th>
          <th class="border border-black border-solid rounded-md"></th>
          <th class="border border-black border-solid rounded-md"></th>
        </tr>
        @foreach($articles as $article)
        <tr>
          <td class="border border-black border-solid rounded-md">{{$article->titre}}</td>
          <td class="border border-black border-solid rounded-md">{{$article->etat->nom_etat}}</td>
          <td class="border border-black border-solid rounded-md"> {{ \Carbon\Carbon::parse($article->date_debut)->format('d/m/Y') }}</td>
          <td class="border border-black border-solid rounded-md"> {{ \Carbon\Carbon::parse($article->date_fin)->format('d/m/Y') }}</td>
          <td class="border border-black border-solid rounded-md"><a href="{{ route('articles.edit', ['article' => $article->id]) }}"><x-bouton-modif>Modifier</x-bouton-modif></a></td>
          <td class="border border-black border-solid rounded-md">
            <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <x-bouton-suppr  type="submit" onclick="confirmDelete(event)">Supprimer</x-bouton-suppr>
            </form>
          </td>
        </tr>

        @endforeach
      </table>
      {{ $articles->links() }}
    </div>
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