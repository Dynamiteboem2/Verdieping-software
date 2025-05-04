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

        <!-- Display General Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Booking Form -->
            <div class="flex-1 bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Lesson Details</h2>
                <p class="text-gray-700 mb-2">Lesson: {{ $lesson->type }}</p>
                <p class="text-gray-700 mb-2">Duration: {{ $lesson->duration }}</p>
                <p class="text-gray-700 mb-4">Price: €{{ number_format($lesson->price, 2) }}</p>

                <form action="{{ route('book.lesson.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                    <input type="hidden" name="price" value="{{ $lesson->price }}">

                    <!-- Select Date -->
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium">Select Date</label>
                        <input type="text" name="date" id="date" class="w-full border-gray-300 rounded mt-1 @error('date') border-red-500 @enderror" placeholder="DD/MM/YYYY" value="{{ old('date') }}" required>
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select Time -->
                    <div class="mb-4">
                        <label for="time" class="block text-sm font-medium">Select Time</label>
                        <input type="time" name="time" id="time" class="w-full border-gray-300 rounded mt-1 @error('time') border-red-500 @enderror" value="{{ old('time') }}" required>
                        @error('time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select Instructor -->
                    <div class="mb-4">
                        <label for="instructor_id" class="block text-sm font-medium">Select Instructor</label>
                        <select name="instructor_id" id="instructor_id" class="w-full border-gray-300 rounded mt-1 @error('instructor_id') border-red-500 @enderror" required>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                    {{ $instructor->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('instructor_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Buy
                    </button>
                </form>
            </div>

            <!-- Personal Information Section -->
            <div class="w-full md:w-1/3 bg-white p-4 rounded shadow self-start">
                <h2 class="text-lg font-bold mb-4">Personal Information</h2>
                <form action="{{ route('book.lesson.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded mt-1 @error('name') border-red-500 @enderror" placeholder="Your Name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" id="email" class="w-full border-gray-300 rounded mt-1 @error('email') border-red-500 @enderror" placeholder="Your Email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="w-full border-gray-300 rounded mt-1 @error('phone_number') border-red-500 @enderror" placeholder="Your Phone Number" value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
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