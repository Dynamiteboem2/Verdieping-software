{{-- filepath: resources/views/instructor/customers.blade.php --}}
<x-app-layout>
    <h1 class="text-2xl font-bold mb-4 text-center">Mijn Klanten</h1>
    <div class="flex justify-center">
        <div class="overflow-x-auto max-w-4xl mx-auto">
            <table class="min-w-full bg-white rounded-lg shadow">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Naam</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Les</th>
                        <th class="px-6 py-3 bg-gray-800 text-left text-xs font-medium text-white uppercase tracking-wider">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->lesson->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap space-x-2">
                            <!-- Cancel for illness -->
                            <form action="{{ route('instructor.cancelBooking', $booking->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="reason" value="ziekte">
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition" onclick="return confirm('Weet je zeker dat je deze les wilt annuleren wegens ziekte?')">Annuleer (Ziekte)</button>
                            </form>
                            <!-- Cancel for wind -->
                            <form action="{{ route('instructor.cancelBooking', $booking->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="reason" value="wind">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded transition" onclick="return confirm('Weet je zeker dat je deze les wilt annuleren wegens wind?')">Annuleer (Wind &gt; 10)</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>