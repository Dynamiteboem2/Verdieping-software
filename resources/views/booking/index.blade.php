<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les boeken</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Navbar component -->
    <x-navbar />

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Boek een les</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @guest
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-6">
                Je moet ingelogd zijn om een reservering te maken.
            </div>
        @endguest

        <!-- Grid layout for lessons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($lessons as $lesson)
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">{{ $lesson->type }}</h2>
                    <ul class="text-gray-700 mb-4">
                        <li>Duur: {{ $lesson->duration }}</li>
                        <li>Prijs: €{{ number_format($lesson->price, 2) }}</li>
                        <li>Maximaal aantal deelnemers: {{ $lesson->max_participants }}</li>
                        <li>{{ $lesson->materials_included }}</li>
                    </ul>
                    @auth
                        <form action="{{ route('book.lesson.create', $lesson->id) }}" method="GET">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Boek nu
                            </button>
                        </form>
                    @else
                        <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" title="Log in om te boeken" disabled>
                            Boek nu
                        </button>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>