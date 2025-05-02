<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Lesson</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Include the navbar component -->
    <x-navbar />

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Book a Lesson</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid layout for lessons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($lessons as $lesson)
                <div class="bg-white p-6 rounded shadow">
                    <h2 class="text-xl font-bold mb-2">{{ $lesson->type }}</h2>
                    <ul class="text-gray-700 mb-4">
                        <li>Duration: {{ $lesson->duration }}</li>
                        <li>Price: €{{ number_format($lesson->price, 2) }}</li>
                        <li>Max Participants: {{ $lesson->max_participants }}</li>
                        <li>{{ $lesson->materials_included }}</li>
                    </ul>
                    <form action="{{ route('book.lesson.create', $lesson->id) }}" method="GET">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Book Now
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>