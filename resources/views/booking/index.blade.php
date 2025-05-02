<!-- filepath: c:\Users\danie\Herd\verdieping-software\resources\views\book-lesson.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Lesson</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Book a Lesson</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('book.lesson.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label for="lesson_id" class="block text-sm font-medium">Select Lesson</label>
                <select name="lesson_id" id="lesson_id" class="w-full border-gray-300 rounded mt-1">
                    @foreach ($lessons as $lesson)
                        <option value="{{ $lesson->id }}">{{ $lesson->type }} - €{{ $lesson->price }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="instructor_id" class="block text-sm font-medium">Select Instructor</label>
                <select name="instructor_id" id="instructor_id" class="w-full border-gray-300 rounded mt-1">
                    @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="location_id" class="block text-sm font-medium">Select Location</label>
                <select name="location_id" id="location_id" class="w-full border-gray-300 rounded mt-1">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Book Lesson
            </button>
        </form>
    </div>
</body>
</html>