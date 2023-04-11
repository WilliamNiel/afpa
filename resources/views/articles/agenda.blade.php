<html>
<head>
    @livewireStyles
    <link href="https://unpkg.com/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="backlink"><a href="{{ route('index')}}"  class="absolute text-red-500 no-underline z-50">Index</a></div>
    <livewire:calendar />
    @livewireScripts
    @stack('scripts')
</body>
</html>