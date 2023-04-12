<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body style="background-color: #CF0043;" class="flex justify-center">
    <div style="background-color: snow;" class="w-11/12 my-10 rounded-lg flex flex-col items-center shadow-xl ">

        <!--  bloc du haut -->

        <div class="w-11/12 flex flex-col items-center sm:items-start gap-5 mt-5">
        <div class="backlink"><a href="{{ route('index')}}"  class="absolute text-red-500 no-underline z-50">Index</a></div>
            <h1 class="w-full h-14 md:h-20 text-center text-xl md:text-4xl font-bold rounded-lg flex items-center justify-center border border-black border-solid rounded-md">Les News de l'AFPA</h1>
        </div>

        <!-- bloc des articles -->

        <div class="w-10/12 flex flex-col items-center justify-center mb-5">
            @foreach ($news as $new)
            <a class="w-full max-w-5xl" href="{{ route('news.show', ['news' => $new['id']]) }}">
                <article class="flex flex-col md:flex-row rounded-xl mt-8 w-full justify-center items-center shadow-lg">
                <!-- image -->
                    <div class="md:w-4/12 flex justify-center items-center p-2">


                        <img class="w-36 sm:w-40" id="imagePreview" src="{{ Storage::url($new->image) }}" alt="image">

                    </div>
                <!--  text -->
                    <div class="w-11/12 md:w-8/12 m-5 ">
                        <h1 class="font-bold ">{{$new['titre']}}</h1>
                        <p>{{$new['contenu']}}</p>
                    </div>
                </article>
            </a>
            @endforeach
        </div>
        {{ $news->links() }}
    </div>
</body>

</html>