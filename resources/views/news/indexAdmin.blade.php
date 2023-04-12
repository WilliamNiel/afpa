<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <title>Document</title>
</head>

<body style="background-color: #CF0043;">
<div class="backlink"><a href="{{ route('index')}}"  class="absolute text-red-500 no-underline z-50">Index</a></div>
  <div class="flex items-center justify-center flex-col h-screen gap-10">
    <div style="background-color: snow;" class="flex items-center justify-center gap-10 h-1/5 flex-col w-4/5 rounded-md text-3xl">
      <h2>Administration News</h2>
    </div>
    <div style="background-color: snow;" class="flex items-center justify-center gap-10 h-3/5 flex-col w-4/5 rounded-md">
      <a href="{{ route('news.create')}}" class="flex-start"><x-bouton-ajouter>Ajouter</x-bouton-ajouter></a>
      <table style="background-color: snow;" class="flex gap-10">
        <tr>
          <th class="border border-black border-solid rounded-md">TITRE</th>
          <th class="border border-black border-solid rounded-md">ETAT</th>
          <th class="border border-black border-solid rounded-md">DATE DE DEBUT</th>
          <th class="border border-black border-solid rounded-md">DATE DE FIN</th>
          <th class="border border-black border-solid rounded-md"></th>
          <th class="border border-black border-solid rounded-md"></th>
        </tr>
        @foreach($news as $new)
        <tr>
          <td class="border border-black border-solid rounded-md">{{$new->titre}}</td>
          <td class="border border-black border-solid rounded-md">{{$new->etat->nom_etat}}</td>
          <td class="border border-black border-solid rounded-md"> {{ \Carbon\Carbon::parse($new->date_debut)->format('d/m/Y') }}</td>
          <td class="border border-black border-solid rounded-md"> {{ \Carbon\Carbon::parse($new->date_fin)->format('d/m/Y') }}</td>
          <td class="border border-black border-solid rounded-md"><a href="{{ route('news.edit', ['news' => $new->id]) }}"><x-bouton-modif>Modifier</x-bouton-modif></a></td>
          <td class="border border-black border-solid rounded-md">
            <form action="{{ route('news.destroy', ['news' => $new->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <x-bouton-suppr  type="submit" onclick="confirmDelete(event)">Supprimer</x-bouton-suppr>
            </form>
          </td>
        </tr>

        @endforeach
      </table>
      {{ $news->links() }}
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