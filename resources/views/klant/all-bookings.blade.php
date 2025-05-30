<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                    Terug naar dashboard
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Al jouw boekingen</h2>
                @if($allBookings->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 rounded shadow">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Type</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Datum</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Tijd</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Locatie</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Status</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Betaald</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($allBookings as $booking)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-900">
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">{{ $booking->lesson->type ?? '-' }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">{{ $booking->time }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">{{ $booking->lesson->location->name ?? '-' }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">{{ $booking->status }}</td>
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">{{ $booking->is_paid ? 'Ja' : 'Nee' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 flex justify-center">
                            @if(method_exists($allBookings, 'links'))
                                {{ $allBookings->links('pagination::tailwind') }}
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-gray-500 mt-4">Je hebt nog geen boekingen.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
