<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KiteSurfschool Windkracht-12</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-800">
        <x-navbar /> <!-- Gebruik het navbar component -->

        <main class="relative">
            <!-- Hero Sectie -->
            <div class="relative h-[93vh] bg-cover bg-center" style="background-image: url('/images/kitesurf.png');">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <div class="relative z-10 flex flex-col justify-center h-full text-left text-white px-8 lg:px-16 max-w-3xl">
                    <h1 class="text-4xl font-bold lg:text-6xl">LEER KITESURFEN</h1>
                    <p class="mt-4 text-lg lg:text-xl">
                        Doe mee met onze kitesurflessen en leer de kunst van het kitesurfen van onze ervaren instructeurs.
                    </p>
                    <a href="{{ route('book.lesson') }}" class="mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-lx rounded w-fit">
                        Plan een les
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
