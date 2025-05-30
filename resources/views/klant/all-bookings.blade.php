<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                    Terug naar dashboard
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-[#0077b6]">Al jouw boekingen</h2>
                @if($allBookings->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border-b text-left">Type</th>
                                    <th class="px-4 py-2 border-b text-left">Datum</th>
                                    <th class="px-4 py-2 border-b text-left">Tijd</th>
                                    <th class="px-4 py-2 border-b text-left">Locatie</th>
                                    <th class="px-4 py-2 border-b text-left">Status</th>
                                    <th class="px-4 py-2 border-b text-left">Betaald</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allBookings as $booking)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                        <td class="px-4 py-2 border-b">{{ $booking->lesson->type ?? '-' }}</td>
                                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2 border-b">{{ $booking->time }}</td>
                                        <td class="px-4 py-2 border-b">{{ $booking->lesson->location->name ?? '-' }}</td>
                                        <td class="px-4 py-2 border-b">{{ $booking->status }}</td>
                                        <td class="px-4 py-2 border-b">{{ $booking->is_paid ? 'Ja' : 'Nee' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-gray-500 mt-4">Je hebt nog geen boekingen.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
