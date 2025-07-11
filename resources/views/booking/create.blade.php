<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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

        <form action="{{ route('book.lesson.store') }}" method="POST" class="flex flex-col md:flex-row gap-6">
            @csrf

            <!-- Booking Form -->
            <div class="flex-[2] bg-white p-6 rounded shadow relative flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-4">Lesson Details</h2>
                    <p class="text-gray-700 mb-2">Lesson: {{ $lesson->type }}</p>
                    <p class="text-gray-700 mb-2">Duration: {{ $lesson->duration }}</p>
                    <p class="text-gray-700 mb-4">Price: €{{ number_format($lesson->price, 2) }}</p>

                    <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                    <input type="hidden" name="price" value="{{ $lesson->price }}">

                    <!-- Select Date -->
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium">Select Date</label>
                        <input type="text" name="date" id="date" class="w-full border-gray-300 rounded mt-1 @error('date') border-red-500 @enderror" placeholder="Select a date" value="{{ old('date') }}" required>
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
                            <option value="">Kies een instructeur</option>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                        @error('instructor_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Select Location -->
                    <div class="mb-4">
                        <label for="location_id" class="block text-sm font-medium">Select Location</label>
                        <select name="location_id" id="location_id" class="w-full border-gray-300 rounded mt-1 @error('location_id') border-red-500 @enderror" required>
                            <option value="">Kies een locatie</option>
                            <option value="Zandvoort" @if(old('location_id')=='Zandvoort') selected @endif>Zandvoort</option>
                            <option value="Muiderberg" @if(old('location_id')=='Muiderberg') selected @endif>Muiderberg</option>
                            <option value="Wijk aan Zee" @if(old('location_id')=='Wijk aan Zee') selected @endif>Wijk aan Zee</option>
                            <option value="IJmuiden" @if(old('location_id')=='IJmuiden') selected @endif>IJmuiden</option>
                            <option value="Scheveningen" @if(old('location_id')=='Scheveningen') selected @endif>Scheveningen</option>
                            <option value="Hoek van Holland" @if(old('location_id')=='Hoek van Holland') selected @endif>Hoek van Holland</option>
                        </select>
                        @error('location_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Buy
                    </button>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="flex-[1] bg-white p-4 rounded shadow self-start">
                <h2 class="text-lg font-bold mb-4">Personal Information</h2>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" id="name" class="w-full border-gray-300 rounded mt-1 @error('name') border-red-500 @enderror" placeholder="Your Name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" id="email" class="w-full border-gray-300 rounded mt-1 @error('email') border-red-500 @enderror" placeholder="Your Email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" 
                        class="w-full border-gray-300 rounded mt-1 @error('phone_number') border-red-500 @enderror" 
                        placeholder="Your Phone Number" 
                        value="{{ old('phone_number', auth()->user()->mobile ?? '') }}" 
                        required
                        pattern="[0-9]+"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    >
                    @error('phone_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="duo_name" class="block text-sm font-medium">Duo Name (optioneel)</label>
                    <input type="text" name="duo_name" id="duo_name" class="w-full border-gray-300 rounded mt-1" value="{{ old('duo_name') }}">
                </div>
                <div class="mb-4">
                    <label for="duo_email" class="block text-sm font-medium">Duo Email (optioneel)</label>
                    <input type="email" name="duo_email" id="duo_email" class="w-full border-gray-300 rounded mt-1" value="{{ old('duo_email') }}">
                </div>
            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#date", {
                dateFormat: "d/m/Y", // Format the date as DD/MM/YYYY
                minDate: "today",    // Disable past dates
            });
        });
    </script>
</body>
</html>