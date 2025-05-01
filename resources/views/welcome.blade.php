<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Windsurf</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-gray-800">
        <header class="bg-white shadow">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">WINDSURF</h1>
                <nav class="space-x-4">
                    <a href="#home" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="#about" class="text-gray-600 hover:text-gray-900">About</a>
                    <a href="#contact" class="text-gray-600 hover:text-gray-900">Contact</a>
                    <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Log in</a>
                </nav>
            </div>
        </header>
 
        <main class="relative">
            <!-- Hero Section -->
            <div class="relative h-[93vh] bg-cover bg-center" style="background-image: url('/images/windsurf.png');">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <div class="relative z-10 flex flex-col justify-center h-full text-left text-white px-8 lg:px-16 max-w-3xl">
                    <h1 class="text-4xl font-bold lg:text-6xl">LEARN TO WINDSURF</h1>
                    <p class="mt-4 text-lg lg:text-xl">
                        Join our windsurfing lessons and learn the art of windsurfing from our experienced instructors.
                    </p>
                    <a href="#lessons" class="mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-lx rounded w-fit">
                        Schedule a Lesson
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
