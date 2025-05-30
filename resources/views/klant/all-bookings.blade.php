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
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase border-b">Actie</th>
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
                                        <td class="px-4 py-2 text-gray-700 dark:text-gray-200 border-b">
                                            @if($booking->status !== 'geannuleerd')
                                                <button onclick="showCancelModal({{ $booking->id }})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">Annuleer</button>
                                            @else
                                                <span class="text-xs text-gray-400">Geannuleerd</span>
                                            @endif
                                        </td>
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
                    <!-- Cancel modal -->
                    <div id="cancelModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg p-6 w-full max-w-md">
                            <h3 class="text-lg font-bold mb-4 text-[#0077b6]">Les annuleren</h3>
                            <form id="cancelForm" method="POST">
                                @csrf
                                <label class="block mb-2 font-semibold">Reden van annulering</label>
                                <textarea name="cancellation_reason" class="border rounded w-full mb-4" required placeholder="Geef een reden op"></textarea>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="hideCancelModal()" class="bg-gray-300 px-4 py-2 rounded">Annuleren</button>
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Verstuur</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        let cancelModal = document.getElementById('cancelModal');
                        let cancelForm = document.getElementById('cancelForm');
                        function showCancelModal(bookingId) {
                            cancelForm.action = '/booking/' + bookingId + '/cancel';
                            cancelModal.classList.remove('hidden');
                            document.body.classList.add('overflow-hidden');
                        }
                        function hideCancelModal() {
                            cancelModal.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }
                    </script>
                @else
                    <div class="text-gray-500 mt-4">Je hebt nog geen boekingen.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
