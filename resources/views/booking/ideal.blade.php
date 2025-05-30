<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>iDEAL Betaling</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow max-w-md w-full text-center">
        <h1 class="text-2xl font-bold mb-4">iDEAL Betaling</h1>
        <p class="mb-6">Betaal voor je lespakket: <strong>{{ $booking->lesson->type }}</strong></p>
        <form method="POST" action="{{ route('booking.ideal.pay', $booking->id) }}">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                Betaal nu
            </button>
        </form>
    </div>
</body>
</html>
