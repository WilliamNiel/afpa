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
    <div><a href="{{ route('news.index')}}" class="text-red-500 no-underline z-50 align-left">Agenda</a></div>
    <div class="flex items-center justify-center flex-col h-screen">
        <div style="background-color: snow;" class="flex items-center justify-center gap-10 h-4/5 flex-col w-4/5 rounded-md">
            <div class="flex justify-center border border-black border-solid rounded-md w-4/5 text-3xl">
                <h2>Du {{$new->date_debut}} au {{$new->date_fin}}</h2>
            </div>

            <div class="border border-black border-solid rounded-md w-4/5 h-4/5 bg-red">
                <div class="flex flex-row justify-center item-center gap-2 mt-2 mb-2">
                    <h3 style="background-color: #87B834;" class="w-1/4 text-2xl"> {{$new->sujet}} </h3>
                    <h1 style="background-color: #44A33D;" class="w-2/4 text-2xl">{{$new->titre}}</h1>
                </div>
                <p class="flex justify-center h-1/2"><img class="" src="{{ Storage::url($new->image) }}"></p>
                <p class="flex justify-center h-1/2">{{$new->contenu}}</p>
            </div>
        </div>
    </div>
</body>

</html>