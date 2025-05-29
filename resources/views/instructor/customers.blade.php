{{-- filepath: resources/views/instructor/customers.blade.php --}}
<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Mijn Klanten</h1>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Les</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->user->email }}</td>
                <td>{{ $booking->lesson->type }}</td>
                <td>
                    <!-- Cancel for illness -->
                    <form action="{{ route('instructor.cancelBooking', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="reason" value="ziekte">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded" onclick="return confirm('Weet je zeker dat je deze les wilt annuleren wegens ziekte?')">Annuleer (Ziekte)</button>
                    </form>
                    <!-- Cancel for wind -->
                    <form action="{{ route('instructor.cancelBooking', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="reason" value="wind">
                        <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="return confirm('Weet je zeker dat je deze les wilt annuleren wegens wind?')">Annuleer (Wind > 10)</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>