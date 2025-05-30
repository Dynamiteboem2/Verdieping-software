<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Bewerk Les & Persoonsgegevens</h2>
        <div class="mb-6">
            <a href="{{ route('instructor.customers') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Terug naar overzicht
            </a>
            <a href="{{ route('klant.allBookings') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2">
                Toon alle boekingen
            </a>
        </div>
        <form method="POST" action="{{ route('instructor.updateBooking', $booking->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Datum</label>
                <input type="date" name="date" value="{{ old('date', $booking->date) }}" class="border rounded w-full" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Tijd</label>
                <input type="time" name="time" value="{{ old('time', $booking->time) }}" class="border rounded w-full" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Naam</label>
                <input type="text" name="user[name]" value="{{ old('user.name', $booking->user->name) }}" class="border rounded w-full" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="user[email]" value="{{ $booking->user->email }}" class="border rounded w-full bg-gray-100 cursor-not-allowed" readonly>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Locatie</label>
                <select name="location_id" class="border rounded w-full" required>
                    @php
                        $locations = ['Zandvoort', 'Muiderberg', 'Wijk aan Zee', 'IJmuiden', 'Scheveningen', 'Hoek van Holland'];
                        $currentLocation = $booking->lesson->location->name ?? '';
                    @endphp
                    @foreach($locations as $loc)
                        <option value="{{ $loc }}" @if($currentLocation == $loc) selected @endif>{{ $loc }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Mobiel</label>
                <input type="text" name="user[mobile]" value="{{ old('user.mobile', $booking->user->mobile) }}" class="border rounded w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
            <a href="{{ route('instructor.customers') }}" class="ml-4 text-gray-600">Annuleren</a>
        </form>
    </div>
</x-app-layout>
