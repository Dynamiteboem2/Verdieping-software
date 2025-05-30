{{-- filepath: resources/views/instructor/customers.blade.php --}}
<x-app-layout>
    <h1 class="text-2xl font-bold mb-4 text-center">Mijn Klanten</h1>
    <div class="flex justify-center mb-4">
        <a href="{{ route('instructor.overview.day') }}" class="bg-blue-500 text-white px-3 py-1 rounded mx-1">Dagoverzicht</a>
        <a href="{{ route('instructor.overview.week') }}" class="bg-blue-500 text-white px-3 py-1 rounded mx-1">Weekoverzicht</a>
        <a href="{{ route('instructor.overview.month') }}" class="bg-blue-500 text-white px-3 py-1 rounded mx-1">Maandoverzicht</a>
    </div>
    <div class="flex justify-center">
        <div class="w-full max-w-5xl">
            <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 rounded-lg shadow mx-auto">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Naam</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Les</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Datum</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Tijd</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Locatie</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider text-center">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-200">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-200">{{ $booking->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-200">{{ $booking->lesson->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-200">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-200">{{ $booking->time }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-200">
                            {{ $booking->lesson->location->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <button @click="open = !open" class="bg-gray-700 hover:bg-gray-900 text-white px-3 py-1 rounded transition focus:outline-none">
                                    Acties
                                </button>
                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10" style="display: none;" x-cloak>
                                    <div class="py-1">
                                        <form action="{{ route('instructor.cancelBooking', $booking->id) }}" method="POST" class="block">
                                            @csrf
                                            <input type="hidden" name="reason" value="ziekte">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-100">Annuleer (Ziekte)</button>
                                        </form>
                                        <form action="{{ route('instructor.cancelBooking', $booking->id) }}" method="POST" class="block">
                                            @csrf
                                            <input type="hidden" name="reason" value="wind">
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-blue-700 hover:bg-blue-100">Annuleer (Wind &gt; 10)</button>
                                        </form>
                                        <a href="{{ route('instructor.editBooking', $booking->id) }}" class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100">Bewerk</a>
                                        <form action="{{ route('instructor.destroyBooking', $booking->id) }}" method="POST" class="block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-100" onclick="return confirm('Weet je zeker dat je deze boeking wilt verwijderen?')">Verwijder</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 flex justify-center">
                {{ $bookings->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>