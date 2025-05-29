<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-bold mb-8">Alle boekingen (overzicht)</h2>
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white rounded-lg shadow-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Instructeur</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Boeker</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Datum</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tijd</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                            <tr>
                                <td class="px-4 py-2 text-gray-700">{{ $booking->instructor->name ?? 'Onbekend' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $booking->user->name ?? 'Onbekend' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $booking->lesson->type ?? 'Onbekend' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $booking->date ?? '-' }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $booking->time ?? '-' }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <form method="POST" action="{{ route('admin.bookings.notify', [$booking->id]) }}">
                                        @csrf
                                        <input type="hidden" name="type" value="sick_instructor">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold shadow">
                                            Ziekmelding instructeur
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.bookings.notify', [$booking->id]) }}">
                                        @csrf
                                        <input type="hidden" name="type" value="windkracht">
                                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-3 py-1 rounded text-xs font-semibold shadow">
                                            Windkracht &gt;10
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Geen boekingen gevonden.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>