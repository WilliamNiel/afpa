<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div><h2>Du {{$article->date_debut}} au {{$article->date_fin}}</h2></div>
<div>
    <h1>{{$article->titre}}</h1>
    <h3> {{$article->sujet}} </h3>
    <p><img src="{{ Storage::url($article->image) }}"></p>
    <p>{{$article->contenu}}</p>
</div>
</body>
</html>