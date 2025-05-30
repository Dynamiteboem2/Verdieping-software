<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4 text-[#0077b6]">
            {{ $overviewType }}overzicht: {{ $overviewDate }}
        </h2>
        <div class="mb-4 flex gap-2">
            <a href="{{ route('instructor.overview.day') }}" class="bg-blue-500 text-white px-3 py-1 rounded">Dag</a>
            <a href="{{ route('instructor.overview.week') }}" class="bg-blue-500 text-white px-3 py-1 rounded">Week</a>
            <a href="{{ route('instructor.overview.month') }}" class="bg-blue-500 text-white px-3 py-1 rounded">Maand</a>
            <a href="{{ route('instructor.customers') }}" class="bg-gray-500 text-white px-3 py-1 rounded">Toon alle boekingen</a>
        </div>
        @if($bookings->count())
            <table class="min-w-full bg-white rounded-lg shadow">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase">Datum</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase">Tijd</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase">Les</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase">Klant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">{{ $booking->time }}</td>
                            <td class="px-6 py-4">{{ $booking->lesson->type }}</td>
                            <td class="px-6 py-4">{{ $booking->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-gray-500 mt-4">Geen lessen gevonden voor dit overzicht.</div>
        @endif
    </div>
</x-app-layout>
