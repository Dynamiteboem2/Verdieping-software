<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Include the navbar component -->
    <x-navbar />

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Complete Your Booking</h1>

        <!-- Lesson Details -->
        <div class="bg-white p-6 rounded shadow mb-6">
            <h2 class="text-xl font-bold mb-2">Lesson: {{ $lesson->type }}</h2>
            <p class="text-xl font-bold mb-2">Duration: {{ $lesson->duration }}</p>
        </div>

        <!-- Booking Form -->
        <form action="{{ route('book.lesson.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
            <input type="hidden" name="price" value="{{ $lesson->price }}">

            <!-- Select Date -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium">Select Date</label>
                <input type="text" name="date" id="date" class="w-full border-gray-300 rounded mt-1" placeholder="DD/MM/YYYY" required>
            </div>

            <!-- Select Time -->
            <div class="mb-4">
                <label for="time" class="block text-sm font-medium">Select Time</label>
                <input type="time" name="time" id="time" class="w-full border-gray-300 rounded mt-1" required>
            </div>

            <!-- Select Instructor -->
            <div class="mb-4">
                <label for="instructor_id" class="block text-sm font-medium">Select Instructor</label>
                <select name="instructor_id" id="instructor_id" class="w-full border-gray-300 rounded mt-1" required>
                    @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Price -->
            <div class="mb-4">
                <h3 class="text-lg font-bold">Total Price: €{{ number_format($lesson->price, 2) }}</h3>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Buy
            </button>
        </form>
    </div>

    <!-- JavaScript to enforce DD/MM/YYYY format -->
    <script>
        const dateInput = document.getElementById('date');
        dateInput.addEventListener('input', (e) => {
            const value = e.target.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            if (value.length >= 2 && value.length <= 4) {
                e.target.value = value.slice(0, 2) + '/' + value.slice(2);
            } else if (value.length > 4) {
                e.target.value = value.slice(0, 2) + '/' + value.slice(2, 4) + '/' + value.slice(4, 8);
            }
        });
    </script>
</body>
</html>