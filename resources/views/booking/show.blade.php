<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Include the navbar -->
    <x-navbar />

    <div class="container mx-auto py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="border-b p-6">
                <h1 class="text-xl font-bold text-gray-800">Booking Details</h1>
                <p class="text-sm text-gray-500">Review the details of your booking below.</p>
            </div>

            <!-- Lesson Details -->
            <div class="p-6 border-b">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Lesson Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <p class="text-gray-700"><strong>Lesson:</strong> {{ $booking->lesson->type }}</p>
                    <p class="text-gray-700"><strong>Duration:</strong> {{ $booking->lesson->duration }}</p>
                    <p class="text-gray-700"><strong>Price:</strong> €{{ number_format($booking->lesson->price, 2) }}</p>
                    <p class="text-gray-700"><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}</p>
                    <p class="text-gray-700"><strong>Time:</strong> {{ $booking->time }}</p>
                    <p class="text-gray-700"><strong>Instructor:</strong> {{ $booking->instructor->name ?? '-' }}</p>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="p-6 border-b">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Personal Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <p class="text-gray-700"><strong>Name:</strong> {{ $booking->name }}</p>
                    <p class="text-gray-700"><strong>Email:</strong> {{ $booking->email }}</p>
                    <p class="text-gray-700"><strong>Phone Number:</strong> {{ $booking->phone_number }}</p>
                </div>
            </div>

            <!-- Footer with Action Button -->
            <div class="p-6 text-center">
                <a href="{{ route('book.lesson') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Back to Bookings
                </a>
            </div>
        </div>
    </div>
</body>
</html>